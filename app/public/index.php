<?php
include_once "./db/connect.php";
include_once "header.php";
include_once "./includes/todo.inc.php";
include_once "./includes/todo.functions.inc.php";
?>
<body>
  <div class="wrapper">

    <!-- Login or welcome page with a thoughts sketchpad -->
    <?php
    if (isset($_SESSION["users_id"])) {
      echo "<h1>Something 🌧n your weary mind? </h1>

      <div class='listitem'>
        <form class='index__login--form' action='index.php' method='post'>
          <input class='input-task' type='text' name='task' placeholder='Write it down here'>
          <textarea class='input-tasktext' rows='5' type='text' name='tasktext' placeholder='... and in more detail!'></textarea>
          <br>
      </div>
      <input class='button' type='submit' name='submit' id='submit' value='Save It For Later'>
      </form>";

      if ($_SESSION["message"] !== "") {
        echo $_SESSION["message"];
        $_SESSION["message"] = "";
      }
    } else {
      echo "<h1>Welcome to a sacred place to collect your thoughts</h1>
        <div class='index__login'>
          <h4>Login here</h4>
              <form class='index__login--form' action='/includes/login.inc.php' method='post'>
                <input type='text' name='uid' placeholder='Username/E-mail'>
                <input type='password' name='pwd' placeholder='Password'>
                <br>
                <input class='button' type='submit' name='login' id='submit' value='Submit'>
              </form>";
    }
    if (isset($_GET["error"]) && $_GET["error"] == "emptyinput") {
      echo "Please fill in both fields!";
    }
    if (isset($_GET["error"]) && $_GET["error"] == "wronglogin") {
      echo "Wrong username or login!";
    }
    if (isset($_GET["error"]) && $_GET["error"] == "stmtfailed") {
      echo "Login error!";
    }
    ?>                    
      </div>
  </div>

</body>
</html>
