<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;

session_start();
include 'db_config.php';

// Check login
if (!isset($_SESSION["user_id"])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION["user_id"];

// Fetch latest booking
$query = "SELECT * FROM bookings WHERE user_id = $user_id ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    die("No booking found.");
}

$ticket = mysqli_fetch_assoc($result);

// Convert logo.jpg to Base64
$imagePath = 'logo1.jpg'; // Ensure this path is correct relative to this file
if (file_exists($imagePath)) {
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
    $imageSrc = 'data:image/' . $imageType . ';base64,' . $imageData;
} else {
    $imageSrc = ''; // Fallback: you can use a placeholder or leave it empty
}

// Generate HTML content with Base64 logo
$html = '
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f1ea;
            margin: 0;
            padding: 30px;
        }
        .ticket-container {
            width: 600px;
            margin: auto;
            background-color: #fffef6;
            border: 2px solid #aaa;
            border-radius: 10px;
            padding: 30px;
            position: relative;
        }
        .logo {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 130px;
        }
        h2 {
            text-align: center;
            color: #444;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        hr {
            margin: 20px 0;
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
    <div class="ticket-container">
        <img src="' . $imageSrc . '" class="logo" alt="Train Logo">
        <h2>Rail Voyage E-Ticket</h2>
        <hr>
        <p><strong>Passenger Name:</strong> ' . htmlspecialchars($ticket['passenger_name']) . '</p>
        <p><strong>Train Number:</strong> ' . htmlspecialchars($ticket['train_no']) . '</p>
        <p><strong>Class:</strong> ' . htmlspecialchars($ticket['seat_class']) . '</p>
        <p><strong>Journey Date:</strong> ' . htmlspecialchars($ticket['journey_date']) . '</p>
        <hr>
        <p style="text-align:center;">Thank you for booking with us!</p>
        <div class="footer">
            For help, contact support@railwayapp.com | 📞 +91-12345-67890
        </div>
    </div>
</body>
</html>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("e-ticket.pdf", ["Attachment" => true]);
exit;
?>
