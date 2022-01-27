<?php
// Login functions

function emptyInputLogin($uid, $pwd)
{
  $result = false;
  if (empty($uid) || empty($pwd)) {
    $result = true;
  }
  return $result;
}

function uidExists($db, $uid, $email)
{
  if (
    !($stmt = $db->prepare(
      "SELECT * FROM users WHERE users_uid = :users_uid OR users_uid = :users_email;"
    ))
  ) {
    header("location: ../pages/signup.php?error=stmtfailed");
    exit();
  }

  $stmt->execute(["users_uid" => $uid, "users_email" => $email]);
  if ($row = $stmt->fetch()) {
    return $row;
  } else {
    $result = false;
    return $result;
  }
}

function getUserId()
{
  if (isset($_SESSION["users_id"])) {
    $id = $_SESSION["users_id"];
    // echo $_SESSION["users_id"];
    /*$stmt = $db->prepare("SELECT * FROM users WHERE users_id=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    echo $_SESSION["users_id"]; */
    return $id;
  }
}

function login($db, $uid, $pwd)
{
  $uidExists = uidExists($db, $uid, $uid);

  if ($uidExists === false) {
    header("location: ../index.php?error=wronglogin");
    exit();
  }
  $pwdHashed = $uidExists["users_pwd"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if ($checkPwd === false) {
    header("location: ../index.php?error=wronglogin");
    exit();
  } elseif ($checkPwd === true) {
    session_start();
    $_SESSION["users_id"] = $uidExists["users_id"];
    $_SESSION["users_uid"] = $uidExists["users_uid"];
    getUserId();
    header("location: ../index.php");
    exit();
  }
}

// Signup functions

function emptyInputSignup($uid, $pwd, $pwdRepeat, $email)
{
  $result = null;
  if (empty($uid) || empty($pwd) || empty($pwdRepeat) || empty($email)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function invalidUid($uid)
{
  $result = null;
  if (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function invalidEmail($email)
{
  $result = null;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
  $result = null;
  if ($pwd !== $pwdRepeat) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function createUser($db, $email, $username, $pwd)
{
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  if (
    !($stmt = $db->prepare(
      "INSERT INTO users (users_uid, users_pwd, users_email) VALUES (:usersUid, :usersPwd, :usersEmail);"
    ))
  ) {
    header("location: ../pages/signup.php?error=stmtfailed");
    exit();
  }
  $stmt->execute([
    "usersEmail" => $email,
    "usersUid" => $username,
    "usersPwd" => $hashedPwd,
  ]);
  header("location: ../index.php?error=none");
  exit();
}
