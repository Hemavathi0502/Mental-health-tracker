<?php
session_start();
$email = $_SESSION['user_email'] ?? '';

$conn = new mysqli("localhost", "root", "", "mental_health_tracker1");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$feedback = $conn->real_escape_string($_POST['feedback']);
if ($email && $feedback) {
    $sql = "INSERT INTO feedback (email, feedback_text, submitted_at) VALUES ('$email', '$feedback', NOW())";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thank you for your feedback!'); window.location.href='Welcome.html';</script>";
    } else {
        echo "Error saving feedback: " . $conn->error;
    }
} else {
    echo "<script>alert('Session expired or feedback missing.'); window.location.href='welcome.html';</script>";
}

$conn->close();
?>