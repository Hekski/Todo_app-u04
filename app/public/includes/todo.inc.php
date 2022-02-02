<?php
include_once "todo.functions.inc.php";

// Function and button triggers/listeners
if (isset($_POST["newtask"])) {
  newtask($db, $_SESSION["users_id"]);
}

if (isset($_POST["deleteAll"])) {
  deleteAll($db);
}

if (isset($_POST["submit"])) {
  $task = $_POST["task"];
  $tasktext = $_POST["tasktext"];

  if (emptyInputSubmit($task, $tasktext) !== false) {
    $_SESSION["message"] = "Please fill in both fields";
  } else {
    submit($db, $_SESSION["users_id"]);
    $_SESSION["message"] = "Note created";
  }
}

if (isset($_POST["update"])) {
  update($db);
}

if (isset($_POST["delete"])) {
  delete($db);
}

if (isset($_POST["complete"])) {
  complete($db);
}
?>
