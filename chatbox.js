document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('chat-form');
    const input = document.getElementById('user-message');
    const chatWindow = document.getElementById('chat-window');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const userMessage = input.value.trim();
        if (userMessage !== "") {
            addMessage("You", userMessage);
            detectMood(userMessage.toLowerCase());
            input.value = "";
        }
    });

    function addMessage(sender, message) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message');
        messageDiv.innerHTML = <strong>${sender}:</strong> ${message};
        chatWindow.appendChild(messageDiv);
        chatWindow.scrollTop = chatWindow.scrollHeight;
    }

    function detectMood(message) {
        let emoji = "🙂";
        let response = "";
        let moodToSave = "";
        let buttonNeeded = false;

        if (message.includes("sad")) {
            emoji = "😢";
            response = "Feeling sad? Let's lift your mood!";
            moodToSave = "Sad";
            buttonNeeded = true;
        } else if (message.includes("happy")) {
            emoji = "😄";
            response = "Feeling happy? That's amazing!";
            moodToSave = "Happy";
        } else if (message.includes("angry")) {
            emoji = "😡";
            response = "Feeling angry? Let's calm down!";
            moodToSave = "Angry";
            buttonNeeded = true;
        } else if (message.includes("confused")) {
            emoji = "😕";
            response = "Feeling confused? It's okay, take a deep breath.";
            moodToSave = "Confused";
            buttonNeeded = true;
        } else if (message.includes("excited")) {
            emoji = "🤩";
            response = "Feeling excited? Woohoo! Keep that energy!";
            moodToSave = "Excited";
        } else if (message.includes("stressed")) {
            emoji = "😖";
            response = "Feeling stressed? Let's relax and breathe.";
            moodToSave = "Stressed";
            buttonNeeded = true;
        } else if (message.includes("anxiety") || message.includes("anxious")) {
            emoji = "😰";
            response = "Feeling anxious? Let's find calmness together.";
            moodToSave = "Anxiety";
            buttonNeeded = true;
        } else if (message.includes("depressed")) {
            emoji = "😞";
            response = "Feeling depressed? You're not alone. Let's explore positive vibes.";
            moodToSave = "Depressed";
            buttonNeeded = true;
        } else if (message.includes("calm")) {
            emoji = "🧘";
            response = "Feeling calm? That's wonderful. Stay grounded.";
            moodToSave = "Calm";
        } else {
            emoji = "🙂";
            response = "Thanks for sharing your mood!";
            moodToSave = "Unknown";
        }

        addMessage("Bot", ${emoji} ${response});

        if (moodToSave !== "") {
            saveMood(moodToSave);
        }

        if (buttonNeeded) {
            const exploreButton = document.createElement('button');
            exploreButton.textContent = "Explore More";
            exploreButton.classList.add('explore-btn');
            exploreButton.onclick = function() {
                window.location.href = "explore.php"; // page to show uplifting content
            };
            chatWindow.appendChild(exploreButton);
        }

        chatWindow.scrollTop = chatWindow.scrollHeight;
    }

    function saveMood(mood) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'chatbox.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('mood=' + encodeURIComponent(mood));
    }
});