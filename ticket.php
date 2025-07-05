<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION["user_id"];
$query = "SELECT * FROM bookings WHERE user_id = $user_id ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$ticket = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Train E-Ticket</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fefefe;
            background-image:url('logo.jpg');
            background-repeat: no-repeat;
            background-position: bottom right;
            background-size: 250px auto; /* adjust size as needed */
            background-attachment: fixed;
            margin: 0;
            padding: 40px 0;
        }

        .ticket-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 600px;
            margin: auto;
            padding: 30px;
            position: relative;
        }

        .ticket-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ticket-header h2 {
            margin: 0;
            color: #2e7d32;
        }

        .logo {
            width: 150px;
        }

        .ticket-info {
            margin-top: 20px;
        }

        .ticket-info p {
            font-size: 16px;
            margin: 10px 0;
        }

        .buttons {
            text-align: center;
            margin-top: 30px;
        }

        button, a.button {
            padding: 10px 20px;
            background-color: #2e7d32;
            color: white;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 15px;
            margin: 0 10px;
            cursor: pointer;
        }

        button:hover, a.button:hover {
            background-color: #1b5e20;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 30px;
            color: #777;
        }
    </style>
</head>
<body>

<?php if ($ticket): ?>
    <div class="ticket-container">
        <div class="ticket-header">
            <h2>Rail Voyage E-Ticket</h2>
            <img src="logo.jpg" alt="Railway Logo" class="logo">
            <!-- Replace above URL with your logo or path like: images/logo.png -->
        </div>

        <div class="ticket-info">
            <p><strong>Passenger Name:</strong> <?php echo htmlspecialchars($ticket['passenger_name']); ?></p>
            <p><strong>Train Number:</strong> <?php echo htmlspecialchars($ticket['train_no']); ?></p>
            <p><strong>Class:</strong> <?php echo htmlspecialchars($ticket['seat_class']); ?></p>
            <p><strong>Journey Date:</strong> <?php echo htmlspecialchars($ticket['journey_date']); ?></p>
        </div>

        <div class="buttons">
            <button onclick="window.print()">🖨️ Print Ticket</button>
            <a href="generate_ticket_pdf.php" class="button" target="_blank">⬇️ Download E-Ticket</a>
        </div>

        <div class="footer">
            For help, contact support@railwayapp.com | 📞 +91-12345-67890
        </div>
    </div>
<?php else: ?>
    <p style="text-align: center;">No recent bookings found.</p>
<?php endif; ?>

</body>
</html>
