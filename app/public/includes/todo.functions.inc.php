<?php

function emptyInputSubmit($task, $tasktext)
{
  $result = false;
  if (empty($task) || empty($tasktext)) {
    $result = true;
  }
  return $result;
}

//

function submit($db)
{
  $task = $_POST["task"];
  $tasktext = $_POST["tasktext"];

  if (empty($task)) {
    header("Location: ../index.php?mess=error");
  } elseif ($task && $tasktext) {
    $stmt = $db->prepare(
      "INSERT INTO tasklist (taskid, task, tasktext, completed) VALUES ('0','$task', '$tasktext', '0')"
    );
    $stmt->execute();
    header("Location: ../index.php?mess=noted");
  }
}

// Add new task to database with userID

function newtask($db, $id)
{
  $stmt = $db->prepare(
    "INSERT INTO tasklist (task, tasktext, taskid, completed) VALUES ('', '', '$id', '0')"
  );
  $stmt->execute();
}

//

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

//

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

//

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

function deleteAll($db)
{
  $stmt = $db->prepare("DELETE FROM tasklist WHERE completed = 1");

  try {
    $stmt->execute($stmt);
  } catch (Exception $e) {
    echo "Fel!" . $e->getMessage();
  }
}

// Move item up

// Move item down

// Print current tasks

function printTasks($db)
{
  $stmt = $db->prepare(
    "SELECT * FROM tasklist WHERE completed = 0 ORDER BY id"
  );
  $stmt->execute();
  $result = $stmt->fetchAll();

  $listNumber = 1;

  foreach ($result as $task) {
    if ($task["taskid"] == $_SESSION["users_id"]) {
      $listitem = "<div class='listitem'>$listNumber<li><form method='POST' action='dodo.php'>
            <input name='id' type='hidden' value='$task[id]'>
            <input class='input-task' name='task' type='text' value='$task[task]' placeholder='Task'><br>
            <input class='input-tasktext' name='tasktext' type='text' value='$task[tasktext]' placeholder='Description'><br>
            <input class='submit' type='submit' name='update' value='Update'>
            <input class='submit' type='submit' name='delete' value='Delete'>
            <input class='submit' type='submit' name='complete' value='Complete'>
            <input class='submit' type='button' name='moveUp' value='↑'>
            <input class='submit' type='button' name='moveDown' value='↓'>
        </form>
        </li></div>";
      echo $listitem;
      $listNumber++;
    }
  }
}

// Print completed tasks

function printCompletedTasks($db)
{
  $stmt = $db->prepare("SELECT * FROM tasklist WHERE completed = 1");
  $stmt->execute();
  $result = $stmt->fetchAll();

  $listNumber = 1;

  foreach ($result as $task) {
    $listitem = "<li><form method='POST' action='completed.php'>
            $listNumber<input name='id' type='hidden' value='$task[id]'>
            <input class='completed' name='task' type='text' value='$task[task]'>
            <input class='completed' name='tasktext' type='text' value='$task[tasktext]'>
            <input class='submit' type='submit' name='delete' value='Delete'>
        </form>
        </li>";
    echo $listitem;
    $listNumber++;
  }
}
