<?php
include_once "../header.php"; ?>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <title>Document</title>
</head> -->
<body>
    <div class="signup__login">
        <h1>Sign up</h1>
        <p>sign up here!</p>
            <form class="signup__login--form" action="../includes/signup.inc.php" method="post">
                <input type="text" name="uid" placeholder="Username">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwdRepeat" placeholder="Password again">
                <input type="text" name="email" placeholder="E-mail">
                <br>
                <input type="submit" name="submit" id="submit" value="Submit">
            </form>

            <?php if (isset($_GET["error"]) && $_GET["error"] == "epmtyinput") {
              echo "Please fill in all the fields!";
            } elseif (isset($_GET["error"]) && $_GET["error"] == "invaliduid") {
              echo "Please use characters a-z, A-Z, 0-9 for your username!";
            } elseif (
              isset($_GET["error"]) &&
              $_GET["error"] == "invalidemail"
            ) {
              echo "Email can not be used!";
            } elseif (isset($_GET["error"]) && $_GET["error"] == "pwdnomatch") {
              echo "The passwords don´t match!";
            } elseif (isset($_GET["error"]) && $_GET["error"] == "uidexist") {
              echo "Username already registred! Try to login";
            } elseif (isset($_GET["error"]) && $_GET["error"] == "none") {
              echo "Success!";
            } ?>
    </div>  
</body>
</html>
