<?php
include_once "../db/connect.php";
include_once "../includes/todo.inc.php";
include_once "../header.php";
?>

<!-- Yesterdays thoughts -->
<body>
    <main>
        <div class="wrapper">
            <section class="completed__section">
                <h1>Yesterdays thoughts:</h1>
                    <form class='index__login--form' action='completed.php' method='post'>
                    <input class='submit' type='button' name='deleteAll' value='Set thoughts free'>
                    <input class='submit' type='hidden' name='test' value='test'></form>
                    
                    <!-- Rendering of yesterdays thoughts -->
                    <ul>
                        <?php printCompletedTasks($db); ?>
                    </ul>

            </section>
        </div>
    </main>
</body>
</html>

    
