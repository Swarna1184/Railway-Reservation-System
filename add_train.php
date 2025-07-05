<?php
include "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $train_number = $_POST["train_number"];
    $train_name = $_POST["train_name"];
    $from_station = $_POST["from_station"];
    $to_station = $_POST["to_station"];
    $departure_time = $_POST["departure_time"];

    $query = "INSERT INTO trains (train_number, train_name, from_station, to_station, departure_time) 
              VALUES ('$train_number', '$train_name', '$from_station', '$to_station', '$departure_time')";

    if (mysqli_query($conn, $query)) {
        echo "Train added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Train</title>
</head>
<body>
    <h2>Add Train Details</h2>
    <form method="POST">
        Train Number: <input type="text" name="train_number" required><br>
        Train Name: <input type="text" name="train_name" required><br>
        From Station: <input type="text" name="from_station" required><br>
        To Station: <input type="text" name="to_station" required><br>
        Departure Time: <input type="time" name="departure_time" required><br>
        <button type="submit">Add Train</button>
    </form>
</body>
</html>
