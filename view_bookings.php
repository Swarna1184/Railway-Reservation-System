<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user ID
$user_query = "SELECT id FROM users WHERE email = '$email'";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);
$user_id = $user['id'];

// Fetch bookings
$booking_query = "SELECT * FROM bookings WHERE user_id = $user_id ORDER BY journey_date DESC";
$booking_result = mysqli_query($conn, $booking_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef8f2;
            background-image: url('logo.jpg');
            background-repeat: no-repeat;
            background-position: bottom right;
            background-size: 250px auto;
            background-attachment: fixed;
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
        a.button {
            display: inline-block;
            padding: 8px 12px;
            background-color: #c62828;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        a.button:hover {
            background-color: #a31515;
        }
        .dashboard-link {
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
        .dashboard-link:hover {
            background-color: #18605f;
        }
        .no-booking {
            text-align: center;
            color: #555;
            font-size: 18px;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <h2>📄 Your Bookings</h2>

    <?php if (mysqli_num_rows($booking_result) > 0): ?>
        <table>
            <tr>
                <th>Passenger Name</th>
                <th>Train Number</th>
                <th>Class</th>
                <th>Journey Date</th>
                
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($booking_result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['passenger_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['train_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['seat_class']); ?></td>
                    <td><?php echo htmlspecialchars($row['journey_date']); ?></td>
                   
                    <td>
                        <form action="cancel_booking.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                            <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="button">Cancel</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p class="no-booking">You have no bookings yet.</p>
    <?php endif; ?>

    <a href="dashboard.php" class="dashboard-link">← Back to Dashboard</a>

</body>
</html>
