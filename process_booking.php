<?php
session_start();
include "db_config.php"; // Database connection

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    die("Unauthorized access. Please <a href='login.php'>Login</a> first.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize inputs
    $train_number = trim($_POST["train_number"]);
    $passenger_name = trim($_POST["passenger_name"]);
    $seat_class = trim($_POST["seat_class"]);
    $journey_date = $_POST["journey_date"];
    $booking_date = date('Y-m-d'); // Today's date
    $user_id = $_SESSION["user_id"];

    // Validate fields
    if (empty($train_number) || empty($passenger_name) || empty($seat_class) || empty($journey_date)) {
        echo "All fields are required.";
        exit();
    }

    // SQL query
    $query = "INSERT INTO bookings (user_id, train_no, passenger_name, seat_class, journey_date, booking_date) 
              VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        // 6 parameters: i (int), s (string), s, s, s, s
        mysqli_stmt_bind_param($stmt, "isssss", $user_id, $train_number, $passenger_name, $seat_class, $journey_date, $booking_date);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Ticket booked successfully!'); window.location.href='confirm.php';</script>";
        } else {
            echo "Error while booking: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Database error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("Location: book.php");
    exit();
}
?>
