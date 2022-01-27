<?php
include_once "./db/connect.php";
include_once "./header.php";
include_once "./includes/login.functions.inc.php";
$id = getUserId();
include_once "./includes/todo.inc.php";

// choice($db);
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
    <!-- CRUD o´ thoughts -->
    <div class="wrapper">
        <?php if (isset($_SESSION["users_uid"])) {
          echo '<h1 class="user_name">' . $_SESSION["users_uid"] . "!</h1>";
          echo "<p>This is your beautiful collective of thoughts...</p>";
        } ?>
        <div class="add__section">
            <form class="add__section--form" method="POST" action="dodo.php">
                <input id="newtask" type="submit" name="newtask" value="> New Thought <">

                <?php if (isset($_GET["mess"]) && $_GET["mess"] == "error") { ?>
                    <p>Please fill in both task and description!</p>
                <?php } ?>

            </form>
        </div>
        <!-- Rendering of thoughts -->
        <section class="todo__section">
                <ul>
                <?php echo printTasks($db); ?>
                </ul>

        </section>            
    </div>           



</body>
</html>