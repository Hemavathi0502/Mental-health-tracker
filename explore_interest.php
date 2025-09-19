<?php
session_start();
$email = $_SESSION['user_email'] ?? '';

// Database connection
$conn = new mysqli("localhost", "root", "", "mental_health_tracker1");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Fetch the latest selected interest for the user
$sql = "SELECT interest FROM user_interests WHERE email = '$email' ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$selected_interest = '';
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $selected_interest = $row['interest'];
}

echo '<link rel="stylesheet" href="styles.css">';
echo '<div class="container">';

echo "<h2>Your Selected Interest: <span style='color:#2c3e50;'>$selected_interest</span></h2>";

switch ($selected_interest) {
    case 'Uplifting Music':
    case 'Music':
    case 'Calming Music':
    case 'Soft Music':
    case 'Random Music':
    case 'Healing Music':
    case 'Uplift Music':
        echo "<audio controls><source src='AUD-20250714-WA0003.mp3' type='audio/mpeg'></audio>";
        echo "<a href='https://open.spotify.com/playlist/37i9dQZF1DX76Wlfdnj7AP'>Listen to your fav music</a>";
        break;
        break;
    case 'Dance Playlist':
    case 'Happy Playlists':
        echo "<audio controls><source src='AUD-20250714-WA0004.mp3' type='audio/mpeg'></audio>";
        echo "<a href='https://open.spotify.com/playlist/37i9dQZF1DX76Wlfdnj7AP'>Listen to your fav music</a>";
        break;
    case 'Relaxing Nature Sounds':
    case 'Nature Sound':
        echo "<audio controls><source src='AUD-20250714-WA0005.mp3' type='audio/mpeg'></audio>";
        echo "<a href='https://open.spotify.com/playlist/37i9dQZF1DX76Wlfdnj7AP'>Listen to your fav music</a>";
        break;
        

    case 'Journaling':
        echo "<h2>Write Your Thoughts</h2>";
        echo "<form method='post'>";      
        echo "<textarea name='entry' placeholder='Write your thoughts here...'></textarea>";
        echo "<input type='hidden' name='interest' value='journaling'>";
        echo "<br><button type='submit' class='button'>Save Journal Entry</button>";
        echo "</form>";

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['entry'])) {
            $entry = strip_tags($_POST['entry']);
            file_put_contents("journal_entries.txt", "$entry\n\n", FILE_APPEND);
            echo "<p><b>Entry saved.</b></p>";
        }
        break;

    case 'Comforting Quotes':
    case 'Hope Quotes':
    case 'Kind Quotes':
        echo "<a href='quotes.html'>quote </a>";
        break;

    case 'Relaxing Videos':
    case 'Relax Video':
    case 'Self-worth Videos':
        echo "<video width='320' height='240' controls><source src='VID-20250713-WA0014 - Copy.mp4' type='video/mp4'></video>";
        break;

    case 'Anger Management Videos':
        echo "<video width='320' height='240' controls><source src='VID-20250712-WA0008.mp4' type='video/mp4'></video>";
        break;
    case 'Motivational Videos':
        echo "<video width='320' height='240' controls><source src='VID_20250712_013703_242.mp4' type='video/mp4'></video>";
        break;

    case 'Motivational Books':
    case 'Light Reading':
        echo "<a href='books.html'>books</a>";
        break;

    case 'Puzzle':
    case 'Puzzle Time':
        echo "<a href='puzzle.html'>Click here to play puzzles</a>";
        break;

    case 'Mindfulness Games':
    case 'Light Games':
    case 'Mini Games':
        echo "<a href='mindfulness_games.html'>Try a game</a>";
        break;

    case 'Creative Drawing':
    case 'Try Drawing':
       echo "<a href='drawing_app.html'>Try drawing </a>";
        break;

    case 'Breathing Timer':
        echo "<p>Try this <a href='breathing_timer.html'>breathing exercise</a>.</p>";
        break;

    case 'Meditation':
    case 'Deep Breathing':
    case 'Guided Relaxation':
        echo "<video width='320' height='240' controls><source src='VID-20250712-WA0010.mp4' type='video/mp4'></video>";
        break;

    case 'Power Nap Tips':
        echo "<a href='power.html'>Try power nap tips </a>";
        break;

    case 'Gentle Yoga':
       echo "<video width='320' height='240' controls><source src='VID-20250713-WA0012.mp4' type='video/mp4'></video>";
        break;

    case 'Self-care Tips':
        echo "<a href='selfcare_tips.html'>Try selfcare tips </a>";
        break;

    case 'Kind Messages':
        echo "<p>You are strong. You are enough. You matter.</p>";
        break;

    case 'Hopeful Stories':
    case 'Positive Stories':
        echo "<a href='stories.html'>Read hopeful real-life stories</a>";
        break;

    case 'Chat with AI':
      echo "<div style='text-align: center; margin-top: 30px;'>
      <a href='https://poe.com/' target='_blank'>
      <button style='padding: 12px 24px; font-size: 16px; background-color: #4A90E2; color: white; border: none; border-radius: 8px; cursor: pointer;'>
      Chat with AI (via Poe)
      </button>
      </a>
      </div>";
      break;

    case 'Funny Memes':
    case 'jokes':
         echo "<a href='memes.html'>memes </a>";
        break;

    
    case 'Workout Suggestions':
        echo "<ul><li>10 Jumping Jacks</li><li>5 Push-ups</li><li>Walk for 5 minutes</li></ul>";
        break;
    case 'Exercises':
    case 'Anxiety Exercise':
        echo "<video width='320' height='240' controls><source src='VID-20250713-WA0012.mp4' type='video/mp4'></video>";
        break;


    case 'Support Articles':
    case 'Read Articles':
        echo "<a href='articles.html'>Read helpful articles</a>";
        break;

    case 'Affirmations':
        echo "<ul><li>I am enough</li><li>I am doing my best</li><li>Today is a new beginning</li></ul>";
        break;

   
    case 'Organizing Tips':
       echo "<a href='organizing.html'>organize</a>";
        break;

    case 'Positive Podcasts':
        echo "<a href='https://open.spotify.com/show/xyz'>Listen to Podcast</a>";
        break;

    case 'Soothing Stories':
        echo "<a href='stories.html'>Soothing bedtime stories</a>";
        break;

    case 'Fun Quizzes':
        echo "<a href='quiz.html'>Take a Fun Quiz</a>";
        break;

    case 'Learn Something':
        echo "<a href='https://www.khanacademy.org/'>Explore new topics</a>";
        break;

    case 'Photo Collage Maker':
        echo "<a href='collage_maker.html'>Make a collage</a>";
        break;

    case 'Share Positivity':
        echo "<textarea placeholder='Write a positive message to share...'></textarea>";
        break;

   
    case 'Explore Hobbies':
       echo "<a href='hobbies.html'>Make a collage</a>";
        break;

    default:
        echo "<p>No specific content found for <b>$selected_interest</b>.</p>";
}
echo "<div style='text-align:center; margin-top: 30px;'>
        <a href='feedback.html' style='
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        '>Give Feedback</a>
      </div>";

echo '</div>';
$conn->close();
?>