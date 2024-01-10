<?php
$servername = "localhost";
$username = "mysql";
$password = "mysql";
$dbname = "events_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Помилка підключення до бази даних: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = $_POST["eventName"];
    $eventCity = $_POST["eventCity"];
    $eventDescription = $_POST["eventDescription"];

    $sql = "INSERT INTO events (city, event_name, description) VALUES ('$eventCity', '$eventName', '$eventDescription')";

    if (mysqli_query($conn, $sql)) {
        echo "Дані успішно додані до бази даних";
        http_response_code(200);
    } else {
        echo "Помилка під час відправки даних на сервер: " . mysqli_error($conn);
        http_response_code(500);
    }
}

mysqli_close($conn);
?>
