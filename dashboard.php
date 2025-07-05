<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fefefe;
            background-image:url('logo.jpg');
            background-repeat: no-repeat;
            background-position: bottom right;
            background-size: 250px auto; /* adjust size as needed */
            background-attachment: fixed;
            padding: 0;
        }

        .navbar {
            background-color: #2b6777;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            background-color: #e74c3c;
            padding: 8px 14px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #c0392b;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            text-align: center;
        }

        .welcome {
            font-size: 20px;
            margin-bottom: 30px;
            color: #2b6777;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            padding: 0 20px;
        }

        .card {
            background-color: white;
            border-radius: 12px;
            padding: 30px 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            margin-bottom: 12px;
            color: #38a3a5;
        }

        .card p {
            color: #555;
            margin-bottom: 18px;
        }

        .card a {
            text-decoration: none;
            background-color: #2b6777;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .card a:hover {
            background-color: #18605f;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>🚆 Rail Voyage Dashboard</h1>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <p class="welcome">Welcome, <strong><?php echo htmlspecialchars($_SESSION['email']); ?></strong>!</p>

        <div class="card-grid">
            <div class="card">
                <h3>✅ Book Ticket</h3>
                <p>Search and reserve train tickets</p>
                <a href="book.php">Book Now</a>
            </div>
            <div class="card">
                <h3>📄 View Bookings</h3>
                <p>Check your ticket history</p>
                <a href="view_bookings.php">View</a>
            </div>
            <div class="card">
                <h3>🚉 Train Schedule</h3>
                <p>Find train timings and routes</p>
                <a href="train_schedule.php">Check</a>
            </div>
            <div class="card">
                <h3>👤 Profile Page</h3>
                <p>Manage your profile & settings</p>
                <a href="profile.php">View Profile</a>
            </div>
        </div>
    </div>

</body>
</html>
