<?php
session_start();
include 'db_config.php'; // Ensure this file exists and connects properly

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //  1️ Prepare and execute SQL query securely
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        //  2️ Verify password
        if (password_verify($password, $hashed_password)) {
            session_regenerate_id(true); // Security: Prevent session fixation
            $_SESSION['user_email'] = $email; // 🔹 Use consistent session key

            echo "<script>('login successful')
                
                window.location.href = 'chatbox.html';
            </script>";
            exit();
        } else {
            echo "<script>alert('❌ Incorrect Password!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('⚠️ User not found! Please register.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
