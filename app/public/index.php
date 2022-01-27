<?php
include_once "./db/connect.php";
include_once "./includes/todo.inc.php";
include_once "header.php";
?>
<body>
    <section class="login">
        <div class="wrapper">
          
          <?php
          if (isset($_SESSION["users_id"])) {
            echo "<h1>Something on your mind?</h1>
            <div class='listitem'><form class='index__login--form' action='index.php' method='post'>
                        <input class='input-task' type='text' name='task' placeholder='Task'>
                        <textarea class='input-tasktext' rows='5' type='text' name='tasktext' placeholder='Description'></textarea><br></div>
                        <input class='submit' type='submit' name='submit' id='submit' value='Submit To Todo-List!'>
                        </form>
                        <form action='/dodo.php' method='post'>
                        <input class='submit' type='submit' id='submit' value='All Your Todos'>
                        </form>";
            if (isset($_GET["mess"]) && $_GET["mess"] == "noted") {
              echo "Noted! Keep track in your personal to-do list";
            }
          } else {
            echo "<h1>Welcome to an todo-app for your tasks!</h1>
              <div class='index__login'>
                <h4>Login here</h4>
                    <form class='index__login--form' action='/includes/login.inc.php' method='post'>
                        <input type='text' name='uid' placeholder='Username/E-mail'>
                        <input type='password' name='pwd' placeholder='Password'><br>
                        <input type='submit' name='submit' id='submit' value='Submit'>
                        </form>";
          }
          if (isset($_GET["error"]) && $_GET["error"] == "emptyinput") {
            echo "Please fill in both fields!";
          }
          if (isset($_GET["error"]) && $_GET["error"] == "wronglogin") {
            echo "Wrong username or login!";
          }
          ?>                    
            </div>
        </div>
        
    </section>
    

</body>
</html>
