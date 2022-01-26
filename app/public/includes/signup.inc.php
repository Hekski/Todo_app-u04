<?php
include_once "../db/connect.php";
include_once "login.functions.inc.php";

// Fetching user data from signup form
if (isset($_POST["submit"])) {
  $uid = $_POST["uid"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdRepeat"];
  $email = $_POST["email"];


  // Error handlers on user signup
  if (emptyInputSignup($uid, $pwd, $pwdRepeat, $email) !== false) {
    header("location: ../pages/signup.php?error=epmtyinput");
    exit();
  }

  if (invalidUid($uid) !== false) {
    header("location: ../pages/signup.php?error=invaliduid");
    exit();
  }

  if (invalidEmail($email) !== false) {
    header("location: ../pages/signup.php?error=invalidemail");
    exit();
  }

  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../pages/signup.php?error=pwdnomatch");
    exit();
  }

  if (uidExists($db, $uid, $email) !== false) {
    header("location: ../pages/signup.php?error=uidexist");
    exit();
  }

  createUser($db, $uid, $pwd, $pwdRepeat, $email);
} else {
  header("location: ../pages/index.php");
  exit();
}

?>
