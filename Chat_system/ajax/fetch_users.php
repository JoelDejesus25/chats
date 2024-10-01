<?php
include "../conn.php"; // Update this based on your folder structure

session_start();
$user_id = $_SESSION['user_id']; // Assuming you have a session variable for logged-in user

$query = "SELECT * FROM users WHERE id != ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo '<div class="user-item" data-id="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['username']) . '</div>';
}

$stmt->close();
$conn->close();
?>
<Script>
function loadUsers() {
    $.ajax({
        url: 'ajax/fetch_users.php', // This script fetches the list of users
        method: 'GET',
        success: function(data) {
            $('#user-list').html(data); // Update user list with new data
        },
        error: function(xhr, status, error) {
            console.error("Error loading users:", error);
        }
    });
}

function loadMessages() {
    $.ajax({
        url: 'ajax/fetch_messages.php', // This script fetches the messages
        method: 'GET',
        success: function(data) {
            $('#chat-messages').html(data); // Update chat messages with new data
        },
        error: function(xhr, status, error) {
            console.error("Error loading messages:", error);
        }
    });
}
</script>