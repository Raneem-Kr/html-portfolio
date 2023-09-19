<?php

$host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'minishop';


$mysqli = new mysqli($host, $db_username, $db_password, $db_name);


if ($mysqli->connect_error) {
    die('Verbindung zur Datenbank fehlgeschlagen: ' . $mysqli->connect_error);
}


$sql = "SELECT * FROM users";


$result = $mysqli->query($sql);


$users = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}


$mysqli->close();


header('Content-Type: application/json');
echo json_encode($users);
?>
