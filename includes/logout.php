<?php
session_start();
require_once 'connection.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Обновление статуса сессии в базе данных
    $stmt = pdo()->prepare("UPDATE `users` SET `session_status` = 0 WHERE `id` = :id");
    $stmt->execute(['id' => $user_id]);

    // Завершение сессии
    session_unset();
    session_destroy();
}

header('Location:/');
exit;
?>
