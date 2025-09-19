<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: admin_login.html");
  exit();
}
require 'db_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="styl.css">
</head>
<body>
  <div class="dashboard-container">
    <h2>Welcome, <?php echo $_SESSION['admin']; ?></h2>
    <a href="logout.php" class="logout-button">Logout</a>

    <h3>User Mood Entries</h3>
    <table>
      <tr>
        <th>Email</th>
        <th>Mood</th>
        <th>Timestamp</th>
      </tr>
      <?php
      $mood_result = $conn->query("SELECT * FROM mood ORDER BY timestamp DESC");
      while ($row = $mood_result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['email']}</td>
                <td>{$row['mood_text']}</td>
                <td>{$row['timestamp']}</td>
              </tr>";
      }
      ?>
    </table>

    <h3>User Feedback</h3>
    <table>
      <tr>
        <th>Email</th>
        <th>Message</th>
        <th>Submitted At</th>
      </tr>
      <?php
      $feedback_result = $conn->query("SELECT * FROM feedback ORDER BY submitted_at DESC");
      while ($row = $feedback_result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['email']}</td>
                <td>{$row['feedback_text']}</td>
                <td>{$row['submitted_at']}</td>
              </tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>