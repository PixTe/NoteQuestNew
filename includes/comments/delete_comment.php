<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'moderator') {
    http_response_code(403);
    echo json_encode(['message' => 'Доступ запрещен']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    
    if ($commentId > 0) {
        $pdo = pdo();
        $stmt = $pdo->prepare('DELETE FROM Comments WHERE id = ?');
        $stmt->execute([$commentId]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Комментарий удален']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Не удалось удалить комментарий']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Некорректный ID комментария']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Метод не поддерживается']);
}
?>
