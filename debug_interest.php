<?php
session_start();

// Sample interests session check (this should be set from a previous form)
if (!isset($_SESSION['selected_interests'])) {
    echo "<p style='color: red;'>No interests selected in session.</p>";
    // For testing, set sample interests manually
    $_SESSION['selected_interests'] = ['books', 'music'];
}

// Define interest recommendations
$interest_recommendations = [
    'books' => [
        'title' => 'Recommended Books',
        'items' => [
            ['name' => 'Atomic Habits', 'image' => 'images/book1.jpg'],
            ['name' => 'The Power of Now', 'image' => 'images/book2.jpg']
        ]
    ],
    'music' => [
        'title' => 'Recommended Music',
        'items' => [
            ['name' => 'Lo-fi Chill Beats', 'image' => 'b2.jpg'],
            ['name' => 'Relaxing Piano', 'image' => 'images/music2.jpg']
        ]
    ]
];

// Get selected interests
$selected_interests = $_SESSION['selected_interests'];

// Debug output
echo "<h3>DEBUG: Selected Interests</h3>";
echo "<pre>";
print_r($selected_interests);
echo "</pre>";

// Display interest-based recommendations
echo "<h2>Interest-Based Recommendations</h2>";
foreach ($selected_interests as $interest) {
    if (isset($interest_recommendations[$interest])) {
        $section = $interest_recommendations[$interest];
        echo "<h3>" . $section['title'] . "</h3>";
        echo "<div style='display: flex; gap: 20px;'>";
        foreach ($section['items'] as $item) {
            echo "<div style='border: 1px solid #ccc; padding: 10px;'>";
            echo "<img src='" . $item['image'] . "' alt='" . $item['name'] . "' style='width: 100px; height: 100px;'><br>";
            echo $item['name'];
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p style='color: orange;'>No recommendations found for interest: <strong>$interest</strong></p>";
    }
}
?>