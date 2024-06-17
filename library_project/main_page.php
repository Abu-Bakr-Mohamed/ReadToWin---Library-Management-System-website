<?php
session_start();
require_once("./includes/dbh.inc.php");

// Check if he enters with a session, and not by typing the URL
if (!empty($_SESSION['authenticated'])) {
    // Function to get books by genre
    function getBooksByGenre($pdo, $genre)
    {
        // Needed data
        $userID = $_SESSION["userID"];
        $currentDate = date("Y-m-d");

        // Getting the data of the book
        $queryGetBooks = "SELECT books.ID, books.Name, books.Author, books.Price, books.quantity, books.image_path
                  FROM books
                  LEFT JOIN departement ON books.IDdepartement = departement.ID
                  WHERE departement.Name = :genre";
        $stmt = $pdo->prepare($queryGetBooks);
        $stmt->bindParam(':genre', $genre);
        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Loop that prints all books for a specific genre
        foreach ($books as $book):
            // Check if the book is in stock
            $inStock = $pdo->prepare("SELECT quantity FROM books WHERE books.ID = :bookID");
            $inStock->bindParam(":bookID", $book["ID"]);
            $inStock->execute();
            $quantity = $inStock->fetchColumn();
            $inStock = ($quantity > 0);

            // Check if the user already borrowed the book
            $isBookBorrowed = $pdo->prepare("SELECT Delivery_date FROM borrowing WHERE borrower_ID = :userID AND IDB = :bookID;");
            $isBookBorrowed->bindParam(":userID", $userID);
            $isBookBorrowed->bindParam(":bookID", $book["ID"]);
            $isBookBorrowed->execute();
            $deliveryDate = $isBookBorrowed->fetchColumn();
            $isBookBorrowed = ($deliveryDate && ($deliveryDate > $currentDate));
            ?>

            <li class="splide__slide">
                <div class="book">
                    <div class="book-image" style="background-image: url('<?= $book['image_path'] ?>')"
                        alt="<?= "Image not found" ?>">
                    </div>
                    <div class="book-info">
                        <h3>
                            <?= $book['Name'] ?>
                        </h3>
                        <h4 class="author-name">
                            By:
                            <?= $book['Author'] ?>
                        </h4>
                        <div class="hidden-info">
                            <div class="book-name">
                                <?= $book['Name'] ?>
                            </div>
                            <div class="price">Price:
                                <span>
                                    <?= $book['Price'] ?>$
                                </span>
                            </div>
                            <div class="quantity">Stock:
                                <span>
                                    <?= $book['quantity'] ?>
                                </span>
                            </div>

                            <?php if ($isBookBorrowed): ?>
                                <button type="submit" class="dimmed-button" disabled>Borrowed</button>
                            <?php elseif (!$inStock): ?>
                                <button type="submit" class="dimmed-button" disabled>Out of Stock</button>
                            <?php else: ?>
                                <form action="./borrow.php" method="GET">
                                    <input type="hidden" name="bookID" value="<?= $book['ID'] ?>">
                                    <button type="submit">Borrow</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach;
    }

    function getRooms($pdo)
    {
        // Getting the data of the rooms
        $queryGetRooms = "SELECT * FROM rooms";
        $stmtGetRooms = $pdo->prepare($queryGetRooms);
        $stmtGetRooms->execute();
        $rooms = $stmtGetRooms->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rooms as $room): ?>
            <tr>
                <td>
                    <?= $room['Room_number'] ?>
                </td>
                <td>
                    <?= $room['Opening_time'] ?>
                </td>
                <td>
                    <?= $room['Closing_time'] ?>
                </td>
            </tr>
        <?php endforeach;
    }

} else {
    // If he didn't enter with a session, redirect him to the reg page
    header("Location: ./index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadToWin Main page</title>
    <!-- Style Sheets -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/main/main_page.css">
    <link rel="stylesheet" href="./css/main/main_page_media.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,600;0,900;0,1000;1,900;1,1000&display=swap">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/all.min.css">
    <!-- Splide -->
    <link href="
    https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css
    " rel="stylesheet">
    <link rel="stylesheet" href="url-to-cdn/splide.min.css">
</head>

<body>
    <header>
        <div class="logo"><span>Read</span>ToWin</div>
        <ul>
            <li>
                <a href="#fiction">Fiction</a>
            </li>
            <li>
                <a href="#history">History</a>
            </li>
            <li>
                <a href="#mystery">Mystery</a>
            </li>
            <li>
                <a href="#science">Science</a>
            </li>
            <li>
                <a href="#rooms">Rooms</a>
            </li>
        </ul>
        <form id="logoutForm" action="./includes/logout_handler.php" method="GET">
            <button type="button" onclick="confirmLogout()">Logout</button>
        </form>
    </header>
    <section id="landing">
        <div class="intro-text">
            <h1>Hello There</h1>
            <p>Explore worlds, ignite minds – read. <i class="fa-solid fa-mug-hot"></i></p>
        </div>
    </section>

    <section id="fiction">
        <h2>Fiction</h2>
        <p> "The more that you read, the more things you will know"</p>
        <div class="container">
            <div class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                        getBooksByGenre($pdo, 'Fiction');
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="history">
        <h2>History</h2>
        <p> "The more that you read, the more things you will know"</p>
        <div class="container">
            <div class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                        getBooksByGenre($pdo, 'History');
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="mystery">
        <h2>Mystery</h2>
        <p> "The more that you read, the more things you will know"</p>
        <div class="container">
            <div class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                        getBooksByGenre($pdo, 'Mystery');
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="science">
        <h2>Science</h2>
        <p> "The more that you read, the more things you will know"</p>
        <div class="container">
            <div class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                        getBooksByGenre($pdo, 'Science');
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="rooms">
        <h2>Rooms</h2>
        <p> "The more that you read, the more things you will know"</p>
        <div class="container wrap-table">
            <table>
                <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Opening Time</th>
                        <th>Closing Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    getRooms($pdo);
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <footer>
        <p>ReadToWin is more than just a platform; it's a gateway to endless worlds, a sanctuary for curious minds.
            Dive into captivating stories across various genres, explore the realms of knowledge, and make the most of
            our
            inviting spaces.
            Follow us to stay engaged.
        </p>
        <div class="contacts">
            <a href="https://www.facebook.com/profile.php?id=100087902827830" target="_blank">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="https://www.facebook.com/profile.php?id=100087902827830" target="_blank">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
            <a href="https://www.facebook.com/profile.php?id=100087902827830" target="_blank">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="https://www.facebook.com/profile.php?id=100087902827830" target="_blank">
                <i class="fa-brands fa-x-twitter"></i>
            </a>
        </div>
    </footer>
    <button id="scrollToTopBtn"><i class="fa-solid fa-angles-up"></i></button>
    <script src="
    https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js
    "></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Genres array to loop through
            var genres = ['fiction', 'history', 'mystery', 'science'];
            genres.forEach(function (genre) {
                // Initialize Splide for each genre
                var splide = new Splide('#' + genre + ' .splide', {
                    perPage: 4,
                    focus: 0,
                    omitEnd: true,
                    breakpoints: {
                        767: {
                            perPage: 1,
                        },
                        991: {
                            perPage: 2,
                        },
                        1200: {
                            perPage: 3,
                        },
                    },
                });

                splide.mount();
            });
        });

        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                // If the user confirms, submit the form
                document.getElementById('logoutForm').submit();
            }
        }

        const scrollToTopBtn = document.getElementById("scrollToTopBtn");

        window.onscroll = function () {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        };

        scrollToTopBtn.addEventListener("click", function () {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
        });

    </script>


</body>

</html>