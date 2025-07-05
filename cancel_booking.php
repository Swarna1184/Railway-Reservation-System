<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id'];

    // First, fetch the booking details before deleting
    $fetch_query = "SELECT b.*, t.train_name FROM bookings b
                    JOIN trains t ON b.train_no = t.train_no
                    WHERE b.id = '$booking_id' AND b.user_id = '$user_id'";
    $result = mysqli_query($conn, $fetch_query);

    if (mysqli_num_rows($result) > 0) {
        $booking = mysqli_fetch_assoc($result);

        $passenger_name = htmlspecialchars($booking['passenger_name']);
        $train_no = htmlspecialchars($booking['train_no']);
        $train_name = htmlspecialchars($booking['train_name']);

        // Now delete the booking
        $delete_query = "DELETE FROM bookings WHERE id = '$booking_id' AND user_id = '$user_id'";
        if (mysqli_query($conn, $delete_query)) {
            echo "<script>
                    alert('🚫 Booking Canceled!\\nPassenger: $passenger_name\\nTrain: $train_name ($train_no)');
                    window.location.href='view_bookings.php';
                  </script>";
        } else {
            echo "<script>alert('❌ Error canceling booking.');</script>";
        }
    } else {
        echo "<script>alert('⚠️ No matching booking found or you are not authorized.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cancel Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #2b6777;
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #2b6777;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #18605f;
        }
    </style>
</head>
<body>

<h2>Cancel Your Booking</h2>
<form method="POST">
    <label>Enter Booking ID to Cancel:</label>
    <input type="text" name="booking_id" required>
    <button type="submit">Cancel Booking</button>
</form>

</body>
</html>
