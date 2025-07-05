<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fefefe;
            background-image:url('logo.jpg');
            background-repeat: no-repeat;
            background-position: bottom right;
            background-size: 250px auto; /* adjust size as needed */
            background-attachment: fixed;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #2b6777;
        }
        form {
            width: 60%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2b6777;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #18605f;
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
    <h2>Train Ticket Booking</h2>
    <form action="process_booking.php" method="POST" id="bookingForm">
        <label for="train_number">Train Number:</label>
        <input type="text" id="train_number" name="train_number" required>

        <label for="passenger_name">Passenger Name:</label>
        <input type="text" id="passenger_name" name="passenger_name" required>

        <label for="seat_class">Class:</label>
        <select id="seat_class" name="seat_class" required>
            <option value="First Class">First Class</option>
            <option value="Second Class">Second Class</option>
            <option value="Sleeper">Sleeper</option>
        </select>

        <label for="journey_date">Journey Date:</label>
        <input type="date" id="journey_date" name="journey_date" required>

        <button type="submit">Book Ticket</button>
    </form>

    <a href="dashboard.php">← Back to Dashboard</a>
</body>
</html>
