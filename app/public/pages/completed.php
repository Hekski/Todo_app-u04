<?php
include_once "../db/connect.php";
include_once "../header.php";
include_once "../includes/todo.inc.php";
?>

<!-- Yesterdays thoughts -->
<body>
    <div class="wrapper">
        <section class="completed__section">
            <h1>Yesterdays thoughts ✈️</h1>
                <form class="index__login--form" action="completed.php" method="POST">
                <input class="button" type="hidden" name="completed" value="1">
                <input class="button" type="submit" name="deleteAll" value="Set Thoughts Free">
                </form>
                
                <!-- Rendering of yesterdays thoughts -->
                <ul>
                    <?php printCompletedTasks($db); ?>
                </ul>
        </section>
    </div>
</body>
</html>

    
