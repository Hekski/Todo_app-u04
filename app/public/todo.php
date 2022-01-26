<?php
include_once "includes/todo.inc.php";
include_once "./db/connect.php";
include_once "header.php";

choice($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">    
    <title>To-do App</title>
</head>
<body>
<main>
    <div class="wrapper">
        <?php if (isset($_SESSION["users_uid"])) {
          echo '<h1 class="user_name">' . $_SESSION["users_uid"] . "!</h1>";
          echo "<p>Welcome to your personal to-do list!</p>";
        } ?>
        <div class="add__section">
            <form class="add__section--form" method="POST" action="todo.php">
                <input id="newtask" type="submit" name="newtask" value="New Task">

                <?php if (isset($_GET["mess"]) && $_GET["mess"] == "error") { ?>
                    <p>Please fill in both task and description!</p>
                <?php } ?>


            </form>
        </div>
        
        <section class="todo__section">
                <ul>
                <?php echo printTasks($db); ?>
                </ul>

        </section>            

        <section class="completed__section">
            <h2>Completed tasks:</h2>

                <ul>
                <?php echo printCompletedTasks($db); ?>
                </ul>

        </section> 
    </div>           
</main>



</body>
</html>