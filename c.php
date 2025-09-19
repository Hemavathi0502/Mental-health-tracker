<?php
session_start();
include 'db_config.php';

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.html");
    exit();
}

$email = $_SESSION['user_email'];
$message = "";

// Mood detected
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mood'])) {
    $mood = strtolower(trim($_POST['mood']));

    // Insert mood into database
    $stmt = $conn->prepare("INSERT INTO mood (email, mood_text, timestamp) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $email, $mood);
    
    if ($stmt->execute()) {
        // Mood successfully saved
    } else {
        echo "Error saving mood: " . $conn->error;
    }

    $stmt->close();

    // Define emoji based on mood
    $emoji = "";
    $button = "";

    if (strpos($mood, 'happy') !== false) {
        $emoji = "😊";
        $button = "<br><a href='explore.php'><button>Your happy!Want to do more fun</button></a>";
    } elseif (strpos($mood, 'sad') !== false) {
        $emoji = "😢";
        $button = "<br><a href='explore.php'><button>Explore to lift your Mood!</button></a>";
        
    } elseif (strpos($mood, 'angry') !== false) {
        $emoji = "😡";
        $button = "<br><a href='explore.php'><button>Feeling angry? Relax here!</button></a>";
    } elseif (strpos($mood, 'stressed') !== false) {
        $emoji = "😰";
        $button = "<br><a href='explore.php'><button>Feeling stressed? Find calm activities!</button></a>";
    } elseif (strpos($mood, 'anxious') !== false) {
        $emoji = "😟";
        $button = "<br><a href='explore.php'><button>Feeling anxious? Relax here!</button></a>";
    } elseif (strpos($mood, 'excited') !== false) {
        $emoji = "😃";
    } else {
        $emoji = "🙂"; // Default neutral emoji
    }

    $message = "<h2>Your mood: $emoji</h2>" . $button;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mood Chatbox</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f8ff;
            text-align: center;
            padding: 50px;
        }
        input[type="text"] {
            width: 60%;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        h2 {
            font-size: 48px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h1>How are you feeling today?</h1>

<form method="POST" action="chatbox.php">
    <input type="text" name="mood" placeholder="Type your feeling (e.g., sad, happy, stressed)">
    <br>
    <button type="submit">Submit</button>
</form>

<div id="response">
    <?php echo $message; ?>
</div>

</body>
</html>