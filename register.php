<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Step 1: Check if email already exists
    $check_query = "SELECT id FROM users WHERE email = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);

    if ($check_stmt) {
        mysqli_stmt_bind_param($check_stmt, "s", $email);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            echo "Email is already registered. <a href='register.html'>Try again</a>";
        } else {
            // Step 2: Proceed with registration
            $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed_password);
                
                if (mysqli_stmt_execute($stmt)) {
                    echo "Registration successful. <a href='login.html'>Login here</a>";
                } else {
                    echo "Error: " . mysqli_stmt_error($stmt);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Error in preparing statement: " . mysqli_error($conn);
            }
        }

        mysqli_stmt_close($check_stmt);
    } else {
        echo "Error in checking email: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
