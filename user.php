<?php
session_start();
require_once 'includes/connection.php';

// Проверяем, авторизован ли пользователь
$is_logged_in = isset($_SESSION['user_id']);

// Если пользователь не авторизован, перенаправляем на страницу входа
if (!$is_logged_in) {
    header('Location: /login');
    exit;
}

// Получаем имя пользователя из URL
$username = $_GET['username'] ?? null;

if (!$username) {
    include( 'public/pages/404.php');
    exit;
}

// Получение информации о запрашиваемом пользователе из базы данных
$stmt = pdo()->prepare("SELECT * FROM `users` WHERE `username` = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Если пользователь не найден, выводится сообщение об ошибке
if (!$user) {
    include( 'public/pages/404.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php include 'public/pages/components/head.php'; ?>
    <link rel="stylesheet" id="theme-style" type="text/css" href="/public/assets/css/light-theme.css">
    <title>Профиль пользователя - <?php echo htmlspecialchars($user['username']); ?></title>
</head>
<body>
    <div class="layout">
        <?php include 'public/pages/components/navbar.php'; ?>
        <main class="user-page">
            <div class="user-block">
            <div class="avatar-name"><?php echo '<img src="../public/assets/media/avatars/' . htmlspecialchars($_SESSION['avatar']) . '" alt="Avatar" class="avatar">'; 
            echo htmlspecialchars($user['username']) ?></div>
                
                <!-- Здесь можно добавить дополнительные данные о пользователе -->
            </div>
        </main>
        <?php include 'public/pages/components/footer.php'; ?>
    </div>
</body>
<script src="/public/assets/js/main.js"></script>
</html>
