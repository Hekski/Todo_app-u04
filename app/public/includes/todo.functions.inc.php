<?php

// Checking for empty submit fields

function emptyInputSubmit($task, $tasktext)
{
  $result = false;
  if (empty($task) || empty($tasktext)) {
    $result = true;
  }
  return $result;
}

// Submit function for welcome page (Must fix: Doesnt send personal input to db)

function submit($db, $id)
{
  $task = $_POST["task"];
  $tasktext = $_POST["tasktext"];

  $stmt = $db->prepare(
    "INSERT INTO tasklist (task, tasktext, taskid, completed) VALUES ('$task', '$tasktext', '$id', '0')"
  );
  $stmt->execute();
}

// Add new task to database with userID

function newtask($db, $id)
{
  $stmt = $db->prepare(
    "INSERT INTO tasklist (task, tasktext, taskid, completed) VALUES ('', '', '$id', '0')"
  );
  $stmt->execute();
}

// Update/confirm input in "My thoughts"

function update($db)
{
  $task = $_POST["task"];
  $tasktext = $_POST["tasktext"];
  $id = $_POST["id"];

  $stmt = $db->prepare(
    "UPDATE tasklist SET task = :task, tasktext = :tasktext WHERE id = :id"
  );
  try {
    $stmt->execute([
      "task" => $task,
      "tasktext" => $tasktext,
      "id" => $id,
    ]);
  } catch (Exception $e) {
    echo "Fel!" . $e->getMessage();
  }
}

// Send thoughts to "Finished thoughts"

function complete($db)
{
  $id = $_POST["id"];
  $stmt = $db->prepare("UPDATE tasklist SET completed = 1 WHERE id = :id");

  try {
    $stmt->execute(["id" => $id]);
  } catch (Exception $e) {
    echo "Fel!" . $e->getMessage();
  }
}

// Delete thoughts from "My thoughts"

function delete($db)
{
  $id = $_POST["id"];
  $stmt = $db->prepare("DELETE FROM tasklist WHERE id = :id");

  try {
    $stmt->execute(["id" => $id]);
  } catch (Exception $e) {
    echo "Fel!" . $e->getMessage();
  }
}

// Delete all old thoughts

function deleteAll($db)
{
  $query = "DELETE FROM tasklist WHERE completed = 1";
  $stmt = $db->prepare($query);
  $stmt->execute();
}

// Print current thoughts

function printTasks($db)
{
  $stmt = $db->prepare(
    "SELECT * FROM tasklist WHERE completed = 0 ORDER BY id"
  );
  $stmt->execute();
  $result = $stmt->fetchAll();

  foreach ($result as $task) {
    if ($task["taskid"] == $_SESSION["users_id"]) {
      $listitem = "<div class='listitem'><li><form method='POST' action='dodo.php'>
            <input name='id' type='hidden' value='$task[id]'>
            <input class='input-task' name='task' type='text' value='$task[task]' placeholder='Thought...'><br>
            <textarea class='input-tasktext' name='tasktext' type='text' value='$task[tasktext]' placeholder='  And Insight...'></textarea>
            <input class='button' type='submit' name='update' value='Update'>
            <input class='button' type='submit' name='delete' value='Delete'>
            <input class='button' type='submit' name='complete' value='Complete'>
            <input class='button' type='hidden' name='moveUp' value='↑'>
            <input class='button' type='hidden' name='moveDown' value='↓'>
        </form>
        </li></div>";
      echo $listitem;
    }
  }
}

// Print completed thoughts

function printCompletedTasks($db)
{
  $stmt = $db->prepare("SELECT * FROM tasklist WHERE completed = 1");
  $stmt->execute();
  $result = $stmt->fetchAll();

  $listNumber = 1;

  foreach ($result as $task) {
    $listitem = "<li><form method='POST' action='completed.php'>
            <input name='id' type='hidden' value='$task[id]'>
            <input class='completed' name='task' type='text' value='$task[task]'>
            <input class='completed' name='tasktext' type='text' value='$task[tasktext]'>
            <input class='button' type='submit' name='delete' value='Delete'>
        </form>
        </li>";
    echo $listitem;
    $listNumber++;
  }
}
