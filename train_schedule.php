<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
include 'db_config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Train Schedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef8f2;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #2b6777;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #38a3a5;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f1f1f1;
        }
        a {
            display: block;
            width: fit-content;
            margin: 20px auto;
            text-align: center;
            padding: 10px 20px;
            background-color: #2b6777;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #18605f;
        }
    </style>
</head>
<body>

<h2>🚉 Train Schedule</h2>

<table>
    <tr>
        <th>Train Name</th>
        <th>Train No</th>
        <th>Source</th>
        <th>Destination</th>
        <th>Departure Time</th>
        <th>Arrival Time</th>
        <th>Date</th>
        <th>Platform</th>
    </tr>

    <?php
    $query = "SELECT t.train_name, t.train_no, t.source, t.destination, ts.departure_time, ts.arrival_time, ts.date, ts.platform
              FROM trains t
              JOIN train_schedule ts ON t.train_no = ts.train_no";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['train_name']}</td>
                <td>{$row['train_no']}</td>
                <td>{$row['source']}</td>
                <td>{$row['destination']}</td>
                <td>{$row['departure_time']}</td>
                <td>{$row['arrival_time']}</td>
                <td>{$row['date']}</td>
                <td>{$row['platform']}</td>
              </tr>";
    }
    ?>

</table>

<a href="dashboard.php">← Back to Dashboard</a>

</body>
</html>
