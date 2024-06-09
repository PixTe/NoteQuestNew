<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // Не авторизован
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['content'], $_POST['lesson_id'])) {
        $content = $_POST['content'];
        $lesson_id = $_POST['lesson_id'];
        $user_id = $_SESSION['user_id'];

        // Подключение к базе данных
        $pdo = pdo();
        $stmt = $pdo->prepare("INSERT INTO comments (lesson_id, user_id, content, created_at) VALUES (:lesson_id, :user_id, :content, NOW())");
        $stmt->bindParam(':lesson_id', $lesson_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Failed to add comment']);
        }
    } else {
        echo json_encode(['error' => 'Invalid input']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
