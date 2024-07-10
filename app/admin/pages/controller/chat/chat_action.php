<?php
session_start();
include "../../../../../config/conn.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'];
$action = $_GET['action'];

if ($action == 'send' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $chat_with = $_POST['chat_with'];

    if ($user_role == 'user') {
        $chat_with = 1; // Mengirim ke admin dengan id 1
    }

    $stmt = $conn->prepare("INSERT INTO chat (user_id, chat_with, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $chat_with, $message);
    $stmt->execute();
    $stmt->close();
} elseif ($action == 'load') {
    $chat_with = $_GET['chat_with'];

    if ($user_role == 'admin') {
        $stmt = $conn->prepare("SELECT chat.*, user.user_username FROM chat JOIN user ON chat.user_id = user.user_id WHERE chat.user_id = ? OR chat.chat_with = ? ORDER BY chat.timestamp ASC");
        $stmt->bind_param("ii", $chat_with, $chat_with);
    } else {
        $stmt = $conn->prepare("SELECT chat.*, user.user_username FROM chat JOIN user ON chat.user_id = user.user_id WHERE (chat.user_id = ? AND chat.chat_with = 1) OR (chat.user_id = 1 AND chat.chat_with = ?) ORDER BY chat.timestamp ASC");
        $stmt->bind_param("ii", $user_id, $user_id);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $isCurrentUser = ($row['user_id'] == $user_id);
        $timeFormatted = date('H:i', strtotime($row['timestamp']));

        echo '<div class="p-2 mb-2 rounded-lg ' . ($isCurrentUser ? 'bg-blue-500 text-right ml-auto' : 'bg-green-800 mr-auto') . '" style="max-width: 50%; word-wrap: break-word;">';
        echo  htmlspecialchars($row['message']);
        echo '<span class="block text-xs text-gray-200">' . $timeFormatted . '</span>';
        echo '</div>';
    }

    $stmt->close();
}
