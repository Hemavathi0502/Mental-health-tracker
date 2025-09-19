<?php
session_start();
$email = $_SESSION['user_email'] ?? 'guest@example.com';
$detected_mood = $_SESSION['detected_mood'] ?? 'neutral';

$mood_interests = [
    'sad' => ['Uplifting Music', 'Journaling', 'Comforting Quotes', 'Relaxing Videos', 'Motivational Books'],
    'angry' => ['Anger Management Videos', 'Workout Suggestions', 'Music', 'Creative Drawing', 'Breathing Timer'],
    'anxious' => ['Meditation', 'Deep Breathing', 'Calming Music', 'Mindfulness Games', 'Anxiety Exercises'],
    'tired' => ['Light Reading', 'Soft Music', 'Power Nap Tips', 'Gentle Yoga', 'Relax Video'],
    'depressed' => ['Self-care Tips', 'Motivational Videos', 'Uplift Music', 'Kind Messages', 'Hopeful Stories'],
    'lonely' => ['Chat with AI', 'Puzzle', 'Funny Memes', 'Exercises', 'Journaling'],
    'worthless' => ['Hope Quotes', 'Support Articles', 'Self-worth Videos', 'Kind Quotes', 'Affirmations'],
    'stressed' => ['Nature Sound', 'Guided Relaxation', 'Organizing Tips', 'Breathing Timer', 'Positive Podcasts'],
    'crying' => ['Soothing Stories', 'Comforting Quotes', 'Relaxing Nature Sounds', 'Self-care Tips','Healing Music'],
    'bored' => ['Fun Quizzes', 'Learn Something', 'Mini Games', 'Dance Playlist', 'Puzzle Time'],
    'happy' => ['Photo Collage Maker', 'Share Positivity', 'Happy Playlists', 'Jokes', 'Positive Stories'],
    'neutral' => ['Explore Hobbies', 'Read Articles', 'Random Music', 'Light Games', 'Try Drawing']
];

$image_urls = [
    'Uplifting Music' => "images/uplifting_music.jpg",
    'Journaling' => "images/journaling.jpg",
    'Comforting Quotes' => "images/comforting Quotes.jpg",
    'Relaxing Videos' => "images/Relaxing Videos.jpg",
    'Motivational Books' => "images/motivational books.jpg",
    'Anger Management Videos' => "images/anger_management.jpg",
    'Workout Suggestions' => "images/workout.jpg",
    'Music' => "images/music.jpg",
    'Creative Drawing' => "images/creative_drawings.jpg",
    'Breathing Timer' => "images/breating_timer.jpg",
    'Meditation' => "images/meditation.jpg",
    'Deep Breathing' => "images/deep_breathing.jpg",
    'Calming Music' => "images/calming_music.jpg",
    'Mindfulness Games' => "images/minfulness_games.jpg",
    'Anxiety Exercises' => "images/anxiety_exercise.jpg",
    'Light Reading' => "images/light_reading.jpg",
    'Soft Music' => "images/soft_music.jpg",
    'Power Nap Tips' => "images/power_nap.jpg",
    'Gentle Yoga' => "images/gentle_yoga.jpg",
    'Relax Video' => "images/relax_video.jpg",
    'Self-care Tips' => "images/self_care.jpg",
    'Motivational Videos' => "images/motivational_video.jpg",
    'Uplift Music' => "images/uplift_music.jpg",
    'Kind Messages' => "images/kind_message.jpg",
    'Hopeful Stories' => "images/hopeful_stories.jpg",
    'Chat with AI' => "images/chat_ai.jpg",
    'Puzzle' => "images/puzzle.jpg",
    'Funny Memes' => "images/funny_memes.jpg",
    'Exercises' => "images/exercise.jpg",
    'journaling'=>"mages/journaling.jpg",
    'Hope Quotes' => "images/hope.jpg",
    'Support Articles' => "images/support_articles.jpg",
    'Self-worth Videos' => "images/self_worth_videos.jpg",
    'Kind Quotes' => "images/kind_quotes.jpg",
    'Affirmations' => "images/affirmations.jpg",
    'Nature Sound' => "images/nature_sound.jpg",
    'Guided Relaxation' => "images/guided_relaxation.jpg",
    'Organizing Tips' => "images/organizing_tips.jpg",
    'Breathing Timer' => "images/breathing.jpg",
    'Positive Podcasts'=>"images/posti.jpg",
    'Soothing Stories' => "images/soothing_stories.jpg",
    'comforting quotes'=>"images/quotes.jpg",
    'Relaxing Nature Sounds'=>"images/nature.jpg",
    'Self-care Tips' => "images/self_care.jpg",
    'Healing Music' => "images/healing_music.jpg",
    'Fun Quizzes' => "images/fun_quizzes.jpg",
    'Learn Something' => "images/learn_something.jpg",
    'Mini Games'=>"images/games.jpg",
    'Dance Playlist' => "images/dance_playlist.jpg",
    'Puzzle Time' => "images/puzzle_time.jpg",
    'Photo Collage Maker' => "images/photo_collage.jpg",
    'Share Positivity' => "images/share_positivity.jpg",
    'Happy Playlists' => "images/happy_playlists.jpg",
    'Jokes' => "images/jokes.jpg",
    'Positive Stories' => "images/positive_stories.jpg",
    'Explore Hobbies' => "images/explore_hobbies.jpg",
    'Read Articles' => "images/read_articles.jpg",
    'Random Music' => "images/music.jpg",
    'Light Games' => "images/light_games.jpg",
    'Try Drawing' => "images/try_drawing.jpg"
];

$interests = $mood_interests[$detected_mood] ?? $mood_interests['neutral'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Explore Your Interests</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right,#f8f9fb,rgb(251, 254, 255));
            padding: 40px;
            text-align: center;
            animation: fadeIn 1s ease;
        }
        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }
        h2, h3 {
            color: #333;
        }
        form {
            display: flex;
            flex-wrap:wrap;
            width:100%;
            margin-top: 30px;
            justify-content:space-between;

        }
        .card {
            background-color: #fff;
            border-radius: 20px;
            padding: 25px;
            width: 18%;
            height:250px;
            box-sizing:border-box;
            text-align: center;
            gap:10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
            border-color:pink;
            margin-bottom:20px;

        }
        .card:hover {
            transform: translateY(-8px) scale(1.02);
            background-color:rgb(255, 230, 250);
            border-color:#f3beef;
        }
        .card.selected {
            background-color: #cce5ff;
            border-color: #007bff;
        }
        .card img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 10px;
        }
        button {
            margin-top: 20px;
            padding: 14px 40px;
            font-size: 18px;
            background:rgb(76, 150, 94);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease, background 0.3s ease;
        }
        button:hover {
            background: #218838;
            transform: scale(1.05);
        }
        input[type="checkbox"] {
            display: none;
        }
        .cards-wrapper {
        display: flex;
        justify-content: center;
        }
 
        form {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        max-width: 1000px;
        }
    </style>
</head>
<body>

    <h2>Welcome, <?= htmlspecialchars($email) ?></h2>
    <h3>Based on your mood (<strong><?= htmlspecialchars(ucfirst($detected_mood)) ?></strong>), explore these interests:</h3>

    <div class="cards-wrapper">
    <form method="POST" action="save_interests.php">
        <?php foreach ($interests as $interest): ?>
            <?php
                $id = strtolower(str_replace(' ', '_', $interest));
                $image_url = $image_urls[$interest] ?? 'https://img.icons8.com/color/96/help.png';
            ?>
            <label class="card" for="<?= $id ?>">
                <input type="checkbox" name="interests[]" value="<?= htmlspecialchars($interest) ?>" id="<?= $id ?>">
                <img src="<?= $image_url ?>" alt="<?= htmlspecialchars($interest) ?>">
                <span><?= htmlspecialchars($interest) ?></span>
            </label>
        <?php endforeach; ?>
        <button type="submit">Continue</button>
    </form>
</div>
    <script>
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.addEventListener('click', () => {
                const checkbox = card.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;
                card.classList.toggle('selected');
            });
        });
    </script>
</body>
</html>