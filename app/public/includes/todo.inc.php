<?php
require_once "todo.functions.inc.php";

function choice($db)
{
  if (isset($_POST["newtask"])) {
    newtask($db);
    /*     header("Refresh:0");
     die(); */
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
}
