<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <title>Document</title>
</head>

<nav>
  <div class="wrapper">

    <ul>
      <?php if (isset($_SESSION["users_id"])) {
        echo "<div class='navbar'><li><a href='\index.php'>Home</a></li>
              <li><a href='\dodo.php'>To-dos</a></li>
              <li><a href='\pages\completed.php'>Completed tasks</a></li>
              <li><a href='\pages\logout.php'>Log out</a></li></div>";
      } else {
        echo "<div class='navbar'><li><a href='\pages\signup.php'>Sign Up</a></li>
            <li><a href='\index.php'>Login</a></li></div>";
      } ?> 
    </ul>
  </div>
</nav>
<body>

