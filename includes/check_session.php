<?php
session_start();
require_once 'connection.php';

// Проверка статуса сессии в базе данных
$is_logged_in = false;
if (isset($_SESSION['user_id'])) {
    $stmt = pdo()->prepare("SELECT `session_status` FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['session_status'] == 1) {
        $is_logged_in = true;
    }
}
// Если пользователь авторизован и пытается зайти на страницы регистрации или входа, перенаправляем на его профиль
if ($is_logged_in && (strpos($_SERVER['REQUEST_URI'], '/register') !== false || strpos($_SERVER['REQUEST_URI'], '/login') !== false)) {
    // Получаем имя пользователя из сессии
    $stmt = pdo()->prepare("SELECT `username` FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $username = $user['username'];

    header('Location: http://localhost/' . $username);
    exit;
}
?>
