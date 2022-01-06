<?php
function submit($db)
{
    $task = $_POST['task'];
    $tasktext = $_POST['tasktext'];

    $query = "INSERT INTO tasklist (task, tasktext) VALUES ('$task', '$tasktext')";
    $statement = $db->prepare($query);
    $statement->execute();
}

function update($db) 
{
    $task = $_POST['task'];
    $tasktext = $_POST['tasktext'];
    $id = $_POST['id'];

    $query = "UPDATE tasklist SET task = :task, tasktext = :tasktext WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->execute(["task"=>$task, "tasktext"=>$tasktext, "id"=>$id]);
}

function delete($db) 
{
    $taskid = $_POST['id'];
    $query = "DELETE FROM tasklist WHERE id = :taskid";
    $statement = $db->prepare($query);

try {
$statement->execute(["taskid"=>$taskid]);
} catch (Exception $e) {
    echo "Fel!" . $e->getMessage();
}
}

function printTasks($db)
{
    $query = "SELECT * FROM tasklist ORDER BY id";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    $listNumber = 1;

    foreach ($result as $task)
    {
        $listitem = 
        "<li><form method='POST' action='index.php'>
            $listNumber<input name='id' type='hidden' value='$task[id]'>
            <input name='task' type='text' value='$task[task]'>
            <input name='tasktext' type='text' value='$task[tasktext]'>
            <input type='submit' name='update' value='Update'>
            <input type='submit' name='delete' value='Delete'>
        </form>
        </li>";
        echo $listitem;
        $listNumber ++;
    }
}