<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadToWin Registration</title>
    <!-- Style Sheets -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/landing/landing.css">
    <link rel="stylesheet" href="./css/landing/landing_media.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,600;0,900;0,1000;1,900;1,1000&display=swap"
        rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/all.min.css">
</head>

<body>
    <header>
        <div class="logo"><span>Read</span>ToWin</div>
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
    </header>

    <div class="landing">
        <div class="left-container">
            <p><span>Read</span> for ur life <i class="fa-solid fa-mug-hot"></i></p>
        </div>

        <div class="right-container">
            <div class="registration">
                <input type="checkbox" id="chk" checked>
                <div class="signup">
                    <form action="./includes/sign_up_handler.php" method="POST">
                        <label for="chk">Sign up</label>
                        <div class="wrap-input">
                            <input type="text" name="user-name" placeholder="User name" required>
                        </div>
                        <div class="wrap-input">
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="wrap-input">
                            <input type="text" name="phone" placeholder="Phone number" required>
                        </div>
                        <div class="wrap-input">
                            <input type="text" name="location" placeholder="Location" required>
                        </div>
                        <div class="wrap-input">
                            <input type="password" name="pwd" placeholder="Password" required>
                        </div>
                        <button type="submit">Sign up</button>
                    </form>
                </div>
                <div class="login">
                    <form action="./includes/login_handler.php" method="POST">
                        <label for="chk">Login</label>
                        <div class="wrap-input">
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="wrap-input">
                            <input type="password" name="pwd" placeholder="Password" required>
                        </div>
                        <button type="submit">Login</button>
                    </form>
                    <?php
                    $errorType = isset($_GET['errorType']) ? $_GET['errorType'] : null;
                    if ($errorType) {
                        ?>
                        <div class="error-message">
                            <?= $errorType ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>