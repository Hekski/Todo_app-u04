<?php

// crud submit för 2 input flält vid förfrågan

function submit($db)
{
  $task = $_POST["task"];
  $tasktext = $_POST["tasktext"];

  if (empty($task)) {
    header("Location: ../index.php?mess=error");
  } elseif ($task && $tasktext) {
    $query = "INSERT INTO tasklist (task, tasktext, completed) VALUES ('$task', '$tasktext', '0')";
    $stmt = $db->prepare($query);
    $stmt->execute();
  }
}

//