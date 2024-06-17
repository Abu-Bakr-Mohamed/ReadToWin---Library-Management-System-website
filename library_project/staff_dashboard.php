<?php
session_start();
require_once("./includes/dbh.inc.php");

// Check if he enters with a session, and not by typing the URL
if (!empty($_SESSION['authenticated'])) {
    // Function to get books by genre
    function getBooks($pdo)
    {
        // Getting the data of the book
        $query = "SELECT * FROM books";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Loop that prints all books for a specific genre
        foreach ($books as $book):
            ?>
            <tr>
                <td>
                    <div class="book-image" style="background-image: url('<?= $book['image_path'] ?>')"
                        alt="<?= "Image not found" ?>">
                    </div>
                </td>
                <td>
                    <?= $book['Name'] ?>
                </td>
                <td>
                    <?= $book['Author'] ?>
                </td>
                <td>
                    <?= $book['Price'] ?>$
                </td>
                <td>
                    <?= $book['quantity'] ?>
                </td>
                <td>
                    <?= $book['IDdepartement'] ?>
                </td>
                <td>
                    <div class="buttons">
                        <form action="./edit_book.php" method="GET">
                            <input type="hidden" name="bookID" value="<?= $book['ID'] ?>">
                            <button class="edit" type="submit">Edit</button>
                        </form>
                        <form action="./includes/delete_book_handler.php" method="GET">
                            <button onclick="confirmDelete(<?= $book['ID'] ?>)" class="delete" type="button">Delete</button>
                        </form>
                    </div>
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
    <title>ReadToWin Dashboard</title>
    <!-- Style Sheets -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/staff_dashboard/staff_dashboard.css">
    <link rel="stylesheet" href="./css/staff_dashboard/staff_dashboard_media.css">
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
</head>

<body>
    <header>
        <div class="logo"><span>Read</span>ToWin</div>
        <form id="logoutForm" action="./includes/logout_handler.php" method="GET">
            <button type="button" onclick="confirmLogout()">Logout</button>
        </form>
    </header>

    <main>
        <div class="container search-add">
            <div class="search-container">
                <label for="search">Search:</label>
                <div class="wrap-input">
                    <input type="text" id="search" oninput="filterBooks()" placeholder="Enter book name">
                </div>
            </div>
            <button class="add" type="submit"><a href="./add_book.php">ADD</a></button>
        </div>
        <div class=" container table-container">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Departement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    getBooks($pdo);
                    ?>
                </tbody>
            </table>

        </div>
    </main>
    <script>
        function confirmDelete(bookID) {
            if (confirm('Are you sure you want to delete this book?')) {
                // If the user confirms, redirect to the delete handler with the bookID
                window.location.href = `./includes/delete_book_handler.php?bookID=${bookID}`;
            }
        }
        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                // If the user confirms, submit the form
                document.getElementById('logoutForm').submit();
            }
        }

        function filterBooks() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those that don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // index 1 is the name of the book
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>