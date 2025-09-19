<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate email
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format! <a href='admin_register.html'>Try again</a>");
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        die("Passwords do not match! <a href='admin_register.html'>Try again</a>");
    }

    // Check if password is strong enough
    if (strlen($password) < 6) {
        die("Password must be at least 6 characters long! <a href='admin_register.html'>Try again</a>");
    }

    // Check if the email is already registered
    $check_sql = "SELECT id FROM admin WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        die("Email already registered! <a href='login.html'>Login here</a>");
    }
    $check_stmt->close();

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = "INSERT INTO admin (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! Redirecting to login...'); window.location.href='admin_login.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
