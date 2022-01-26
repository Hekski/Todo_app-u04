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
        echo "<li><a href='\pages\logout.php'>Log out</a></li>";
      } else {
        echo "<li><a href='\pages\signup.php'>Sign Up</a></li>";
        echo "<li><a href='\index.php'>Login</a></li>";
      } ?> 
    </ul>
  </div>
</nav>
<body>