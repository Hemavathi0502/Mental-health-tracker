<?php
session_start();
require 'db_config.php';

$email = $_POST['admin_email'];
$password = $_POST['admin_password'];

$sql = "SELECT * FROM admin WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $row = $result->fetch_assoc();
  // For plain text passwords (not secure — consider hashing)
  if ($row['password'] === $password) {
    $_SESSION['admin'] = $email;
    header("Location: admin_dashboard.php");
    exit();
  } else {
    echo "<script>alert('Incorrect password.'); window.location.href='admin_login.html';</script>";
  }
} else {
  echo "<script>alert('Admin not found.'); window.location.href='admin_login.html';</script>";
}
?>
