<?php
session_start();

// Database config
$host = 'localhost';
$db = 'mental_health_tracker1';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check login session
if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('Please log in to continue.'); window.location.href='login.php';</script>";
    exit();
}

$email = $_SESSION['user_email'];
$mood = $_SESSION['detected_mood'] ?? 'neutral';
$interests = $_POST['interests'] ?? [];

if (!empty($interests) && is_array($interests)) {
    $stmt = $conn->prepare("INSERT INTO user_interests (email, mood, interest) VALUES (?, ?, ?)");
    
    foreach ($interests as $interest) {
        $clean_interest = htmlspecialchars(trim($interest));
        $stmt->bind_param("sss", $email, $mood, $clean_interest);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    echo "<script>alert('Your interests have been saved successfully!'); window.location.href='explore_interest.php';</script>";
    exit();
} else {
    echo "<script>alert('Please select at least one interest.'); window.location.href='explore.php';</script>";
    exit();
}
?>