<?php
// Normalize input: trim + lowercase
$interest = strtolower(trim($_GET['name'] ?? $_POST['interest'] ?? ''));
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo ucfirst($interest); ?> - Interest Activity</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 20px;
            padding: 0;
            background: #f5f8fa;
            color: #333;
        }
        h2 {
            color: #0066cc;
        }
        audio, video {
            display: block;
            margin: 20px 0;
            max-width: 100%;
        }
        img {
            max-width: 300px;
            margin: 10px;
            border-radius: 12px;
        }
        a.button, button.button {
            display: inline-block;
            background: #0066cc;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 8px;
            margin: 10px 5px;
            border: none;
            cursor: pointer;
        }
        textarea {
            width: 100%;
            height: 150px;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php
echo "<p><i>Interest received:</i> <b>$interest</b></p>"; // DEBUG: remove later

switch ($interest) {
    case 'music':
    case 'uplifting music':
    case 'calming music':
    case 'happy playlists':
    case 'dance playlist':
    case 'soft music':
    case 'uplift music':
    case 'relax video':
    case 'healing music':
        echo "<h2>Enjoy Mood-Based Music</h2>";
        echo "<audio controls><source src='music/english1.mp3' type='audio/mpeg'></audio>";
        echo "<audio controls><source src='music/hindi1.mp3' type='audio/mpeg'></audio>";
        echo "<audio controls><source src='music/kannada1.mp3' type='audio/mpeg'></audio>";
        break;

    case 'quotes':
    case 'comforting quotes':
    case 'kind quotes':
    case 'hope quotes':
        echo "<h2>Inspirational & Comforting Quotes</h2>";
        echo "<ul>
                <li>“You are stronger than you think.”</li>
                <li>“Every storm runs out of rain.”</li>
                <li>“Peace begins with a smile.”</li>
                <li>“Start where you are. Use what you have. Do what you can.”</li>
              </ul>";
        break;

    case 'books':
    case 'motivational books':
        echo "<h2>Recommended Books</h2>";
        echo "<ul>
                <li><b>The Power of Now</b> by Eckhart Tolle</li>
                <li><b>Atomic Habits</b> by James Clear</li>
                <li><b>Ikigai</b> by Héctor García</li>
              </ul>";
        break;

    case 'podcasts':
    case 'positive podcasts':
        echo "<h2>Listen to Positive Podcasts</h2>";
        echo "<audio controls><source src='audio/positivity.mp3' type='audio/mpeg'></audio>";
        break;

    case 'videos':
    case 'motivational videos':
    case 'relaxing videos':
        echo "<h2>Relaxing & Motivational Videos</h2>";
        echo "<video controls><source src='videos/relax.mp4' type='video/mp4'></video>";
        echo "<video controls><source src='videos/motivation.mp4' type='video/mp4'></video>";
        break;

    case 'drawing':
    case 'creative drawing':
    case 'try drawing':
        echo "<h2>Express Yourself through Drawing</h2>";
        echo "<a href='drawing_app.html' class='button'>Open Drawing Pad</a>";
        break;

    case 'collage':
    case 'photo collage maker':
        echo "<h2>Create a Mood Collage</h2>";
        echo "<a href='collage_maker.html' class='button'>Start Collage Maker</a>";
        break;

    case 'memes':
    case 'funny memes':
        echo "<h2>Funny Memes to Uplift You</h2>";
        echo "<img src='memes/meme1.jpg' alt='Meme 1'>";
        echo "<img src='memes/meme2.jpg' alt='Meme 2'>";
        break;

    case 'games':
    case 'mini games':
    case 'light games':
    case 'mindfulness games':
        echo "<h2>Interactive Games</h2>";
        echo "<a href='puzzle_game.html' class='button'>Play Puzzle</a>";
        echo "<a href='quiz.html' class='button'>Take Mood Quiz</a>";
        echo "<a href='mindfulness_game.html' class='button'>Play Mindfulness Game</a>";
        break;

    case 'journaling':
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

    case 'relaxation':
    case 'relaxation exercises':
    case 'self-care tips':
    case 'breathing timer':
        echo "<h2>Relaxation & Self-care Tools</h2>";
        echo "<video controls><source src='videos/anger_management.mp4' type='video/mp4'></video>";
        echo "<a href='breathing_timer.html' class='button'>Breathing Timer</a>";
        echo "<a href='selfcare_tips.html' class='button'>Explore Self-care Tips</a>";
        break;

    case 'education':
    case 'learn something':
    case 'support articles':
    case 'read articles':
        echo "<h2>Educational Resources</h2>";
        echo "<a href='articles/brain-emotion.html' class='button'>Understanding Emotions</a>";
        echo "<a href='articles/self-worth.html' class='button'>Building Self-Worth</a>";
        break;

    case 'ai chat':
    case 'chat with ai':
        echo "<h2>Chat with Our AI Assistant</h2>";
        echo "<a href='chatbox.php' class='button'>Start Chat</a>";
        break;

    case 'kind messages':
    case 'positive stories':
    case 'hopeful stories':
    case 'share positivity':
        echo "<h2>Kindness & Positivity Corner</h2>";
        echo "<p>“You matter. You’re not alone.”</p>";
        echo "<p>“Here’s a story of someone who overcame hardship...”</p>";
        echo "<a href='stories/hope.html' class='button'>Read Uplifting Story</a>";
        break;

    case 'workout suggestions':
        echo "<h2>Release Anger through Exercise</h2>";
        echo "<video controls><source src='videos/workout.mp4' type='video/mp4'></video>";
        break;

    case 'puzzle':
    case 'puzzle time':
        echo "<h2>Puzzle Challenge</h2>";
        echo "<a href='puzzle_game.html' class='button'>Start Puzzle</a>";
        break;

    case 'organizing tips':
        echo "<h2>Reduce Stress with Organization</h2>";
        echo "<a href='articles/organizing.html' class='button'>View Organizing Tips</a>";
        break;

    case 'gentle yoga':
        echo "<h2>Gentle Yoga for Calm</h2>";
        echo "<video controls><source src='videos/yoga.mp4' type='video/mp4'></video>";
        break;

    case 'power nap tips':
        echo "<h2>Boost Energy with a Power Nap</h2>";
        echo "<a href='articles/power-nap.html' class='button'>Read Power Nap Tips</a>";
        break;

    default:
        echo "<h2>Oops!</h2><p>We couldn't find any content for '<b>$interest</b>'. Please try another topic.</p>";
        break;
}
?>

</body>
</html>
