<?php
session_start();

$host = 'localhost';
$db = 'mental_health_tracker1';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : 'guest@example.com';
$mood_text = isset($_POST['mood_text']) ? trim($_POST['mood_text']) : '';
$detected_mood = '';

// Mood keywords
$keywords = [
    'sad' => ['sad', 'down', 'blue', 'unhappy', 'broken', 'upset', 'low', 'gloomy', 'heartbroken', 'tearful', 'miserable'],
    'angry' => ['angry', 'mad', 'furious', 'irritated', 'frustrated', 'annoyed', 'rage', 'agitated', 'enraged', 'grumpy'],
    'anxious' => ['anxious', 'nervous', 'worried', 'panicky', 'restless', 'uneasy', 'on edge', 'jittery', 'afraid', 'scared'],
    'tired' => ['tired', 'exhausted', 'fatigued', 'sleepy', 'worn out', 'drained', 'weary', 'sluggish', 'drowsy', 'lazy'],
    'depressed' => ['depressed', 'hopeless', 'despair', 'numb', 'dark', 'lost', 'empty', 'disheartened', 'in pain'],
    'lonely' => ['lonely', 'alone', 'isolated', 'neglected', 'abandoned', 'left out', 'unwanted', 'friendless', 'solitary'],
    'worthless' => ['worthless', 'useless', 'unimportant', 'insignificant', 'meaningless', 'pointless', 'valueless', 'a burden'],
    'stressed' => ['stressed', 'overwhelmed', 'pressured', 'tense', 'tight', 'panicked', 'burned out', 'rushed'],
    'crying' => ['crying', 'tears', 'weep', 'sob', 'sobbing', 'tearful', 'bawling', 'wailing', 'sniffling'],
    'bored' => ['bored', 'dull', 'uninterested', 'lifeless', 'not fun', 'tedious', 'repetitive', 'unmotivated'],
    'happy' => ['happy', 'joyful', 'excited', 'glad', 'pleased', 'cheerful', 'delighted', 'content', 'upbeat', 'grateful'],
    'neutral' => ['okay', 'fine', 'neutral', 'alright', 'so-so', 'normal', 'meh', 'average', 'nothing much']
];

// Mood messages
$mood_messages = [
    'sad' => "It's okay to feel sad. You're not alone. Try exploring something comforting.",
    'angry' => "Anger is valid. Take a deep breath and explore ways to release it safely.",
    'anxious' => "Anxiety is tough. You’re doing your best. Explore something calming.",
    'tired' => "Rest is important. Listen to your body. Try something light.",
    'depressed' => "You matter. You're not alone. Reach out or explore supportive tools.",
    'lonely' => "You are seen. Even in loneliness, connection is possible.",
    'worthless' => "You are valuable and irreplaceable. Explore something that reminds you of that.",
    'stressed' => "Take a breath. You deserve peace. Explore ways to ease the pressure.",
    'crying' => "Crying is healing. Let it out. You’re safe here.",
    'bored' => "It's okay to feel bored. Try something creative or relaxing.",
    'happy' => "That’s wonderful! Explore things that enhance your joy.",
    'neutral' => "Feeling neutral is okay. Explore what sparks your curiosity."
];

// Detect mood
foreach ($keywords as $mood => $words) {
    foreach ($words as $word) {
        if (preg_match("/\b$word\b/i", $mood_text)) {
            $detected_mood = $mood;
            break 2;
        }
    }
}

if (!empty($mood_text)) {
    // Save to database
    $stmt = $conn->prepare("INSERT INTO mood (email, mood_text, detected_mood, timestamp) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $email, $mood_text, $detected_mood);
    $stmt->execute();
    $stmt->close();

    $_SESSION['detected_mood'] = $detected_mood;

    echo "<strong>Detected Mood:</strong> <em>" . ($detected_mood ?: "Neutral / Undetected") . "</em><br>";
    echo "<p>" . $mood_messages[$detected_mood ?: 'neutral'] . "</p>";
} else {
    echo "Please type how you're feeling.";
}

$conn->close();
?>