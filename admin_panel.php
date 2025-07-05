<?php
session_start();
include "db_config.php";

// You can use a separate admin login for better security
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h2>Admin Panel - Manage Bookings</h2>

    <h3>All Bookings</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Train Number</th>
            <th>Passenger Name</th>
            <th>Class</th>
            <th>Date</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM bookings");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['user_id']}</td>
                    <td>{$row['train_number']}</td>
                    <td>{$row['passenger_name']}</td>
                    <td>{$row['seat_class']}</td>
                    <td>{$row['journey_date']}</td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>
