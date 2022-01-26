<?php
include_once "./db/connect.php";
include_once "./includes/todo.inc.php";
include_once "header.php";
?>

<body>
    <section class="login">
        <div class="wrapper">
            <h1>Welcome to an todo-app for your tasks!</h1>
            
            <div class="index__login">
                <h4>Login here</h4>
                    <form class="index__login--form" action="/includes/login.inc.php" method="post">
                        <input type="text" name="uid" placeholder="Username/E-mail">
                        <input type="password" name="pwd" placeholder="Password">
                        <br>

                        <?php 
                        if (isset($_GET["error"]) && $_GET["error"] == "emptyinput") {
                          echo "Please fill in both fields!";
                        } 
                        if (isset($_GET["error"]) && $_GET["error"] == "wronglogin") {
                          echo "Wrong username or login!";
                        } 
                        ?>

                        <input type="submit" name="submit" id="submit" value="Submit">
                    </form>
                <a href='/pages/signup.php'>Sign up!</a></li>

            </div>
        </div>
        
    </section>
    

</body>
</html>
