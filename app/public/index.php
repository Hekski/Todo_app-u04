<?php
include_once "crud.php";
include_once "./db/connect.php";

if (isset($_POST['submit'])) {
    submit($db);
    header("Refresh:0");
    die();
    
} else if (isset($_POST['update'])) {
    update($db);
    header("Refresh:0");
    die();

} else if (isset($_POST['delete'])) {
    delete($db);
    header("Refresh:0");
    die();    
}

// $tasks = $db->query("SELECT * FROM tasklist;")->fetchAll();

// echo '<pre>';
// foreach($tasks as $task) {
//     print_r($task);
// }
// echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>To-do list</title>
</head>
<body>
    <main>
        <h2>To-do:</h2>
        <div class="add-section">
            <form method="POST" action="index.php">
                <label for="text">Enter your Task:</label>
                <input type="text" name="task" id="task" required>
                <label for="text">Description:</label>
                <input type="text" name="tasktext" id="tasktext" required>
                <input type="submit" name="submit" id="submit" value="Submit">
            </form>
        </div>
        
        <section class="show-todo-section">
            <h2>Tasks:</h2>

                <ul>
                <?php 
                echo printTasks($db);
                ?>
                </ul>

        </section>            

        <section class="completed-section">
        <h2>Completed tasks:</h2>

        <?php

        ?>

        </section>            

</main>



</body>
</html>