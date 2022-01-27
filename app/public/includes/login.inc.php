<?php
include "../db/connect.php";
include "login.functions.inc.php";

// Fetching user data from login form
if (isset($_POST["submit"])) {
  $uid = $_POST["uid"];
  $pwd = $_POST["pwd"];

  // Error handlers on user login
  if (emptyInputLogin($uid, $pwd) !== false) {
    header("location: ../index.php?error=emptyinput");
    exit();
  }
  login($db, $uid, $pwd);
} else {
  header("location: ../index.php?error=wronglogin");
  exit();
}
