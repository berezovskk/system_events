<?php

$servername = "localhost";
$username = "mysql";
$password = "mysql";
$dbname = "events_db";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}


$eventCity = $_POST['eventCity'];
$eventName = $_POST['eventName'];
$eventDescription = $_POST['eventDescription'];


$sql = "DELETE FROM events WHERE city = '$eventCity' AND event_name = '$eventName' AND description = '$eventDescription'";

if ($conn->query($sql) === TRUE) {
    echo "Дані успішно видалено";
} else {
    echo "Помилка: " . $conn->error;
}

$conn->close();
?>
