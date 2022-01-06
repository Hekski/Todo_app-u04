<?php

$servername = "mysql";
$username = "henrik";
$password = "secret";
$dbname = "henrikdb";


try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // echo "Connected!";
    } catch(PDOException $e) {
        echo "Bad connection!" . $e->getMessage();
    }
