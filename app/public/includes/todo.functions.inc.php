<?php

function newtask($db)
{
  // Add task to database with userID
  $query =
    "INSERT INTO tasklist (task, tasktext, taskid, completed) VALUES ('', '', '0', '0')";
  $stmt = $db->prepare($query);
  $stmt->execute();
}

function update($db)
{
  $task = $_POST["task"];
  $tasktext = $_POST["tasktext"];
  $id = $_POST["id"];

  $query =
    "UPDATE tasklist SET task = :task, tasktext = :tasktext WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->execute([
    "task" => $task,
    "tasktext" => $tasktext,
    "id" => $id,
  ]);
}

function complete($db)
{
  $id = $_POST["id"];
  $query = "UPDATE tasklist SET completed = 1 WHERE id = :id";
  $stmt = $db->prepare($query);

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
  $query = "DELETE FROM tasklist WHERE id = :id";
  $stmt = $db->prepare($query);

  try {
    $stmt->execute(["id" => $id]);
  } catch (Exception $e) {
    echo "Fel!" . $e->getMessage();
  }
}

//

function printTasks($db)
{
  $query = "SELECT * FROM tasklist WHERE completed = 0 ORDER BY id";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll();

  $listNumber = 1;

  foreach ($result as $task) {
    $listitem = "<li><form method='POST' action='todo.php'>
            $listNumber<input name='id' type='hidden' value='$task[id]'>
            <input class='input-task' name='task' type='text' value='$task[task]' placeholder='Task'><br>
            <input class='input-tasktext' name='tasktext' type='text' value='$task[tasktext]' placeholder='Description'><br>
            <input type='submit' name='update' value='Update'>
            <input type='submit' name='delete' value='Delete'>
            <input type='submit' name='complete' value='Complete'>
            <input type='button' name='moveUp' value='↑'>
            <input type='button' name='moveDown' value='↓'>
        </form>
        </li>";
    echo $listitem;
    $listNumber++;
  }
}

function printCompletedTasks($db)
{
  $query = "SELECT * FROM tasklist WHERE completed = 1";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll();

  $listNumber = 1;

  foreach ($result as $task) {
    $listitem = "<li><form method='POST' action='todo.php'>
            $listNumber<input name='id' type='hidden' value='$task[id]'>
            <input class='completed' name='task' type='text' value='$task[task]'>
            <input class='completed' name='tasktext' type='text' value='$task[tasktext]'>
            <input type='submit' name='delete' value='Delete'>
        </form>
        </li>";
    echo $listitem;
    $listNumber++;
  }
}
