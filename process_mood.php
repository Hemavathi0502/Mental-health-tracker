<?php
session_start();
include 'db_config.php'; // DB connection

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['user_email'];
$mood = trim($_POST['mood']);

if ($mood !== '') {
    $stmt = $conn->prepare("INSERT INTO mood(message, user_email) VALUES (?, ?)");
    $stmt->bind_param("ss", $mood, $user_email);

    if ($stmt->execute()) {
        // Optional log for debugging
        file_put_contents("debug_log.txt", "Insert success: $user_email - $mood\n", FILE_APPEND);
    } else {
        file_put_contents("debug_log.txt", "Insert failed: " . $stmt->error . "\n", FILE_APPEND);
    }

    $stmt->close();
}

$conn->close();
header("Location: chatbox.php?mood=" . urlencode($mood));
exit();
