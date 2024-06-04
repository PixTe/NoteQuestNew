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

// Получаем информацию о запрашиваемом пользователе из базы данных
$stmt = pdo()->prepare("SELECT * FROM `users` WHERE `username` = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Если пользователь не найден, выводим сообщение об ошибке
if (!$user) {
    include( 'public/pages/404.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php include 'public/pages/components/head.php'; ?>
    <link rel="stylesheet" id="theme-style" type="text/css" href="/public/assets/css/style-theme.css">
    <title>Профиль пользователя - <?php echo htmlspecialchars($user['username']); ?></title>
</head>
<body>
    <div class="layout">
        <?php include 'public/pages/components/navbar.php'; ?>
        <main class="user-page">
            <div class="user-block">
                <h1>Здравствуйте, <?php echo htmlspecialchars($user['username']) ?></h1>
                <!-- Здесь можно добавить дополнительные данные о пользователе -->
            </div>
        </main>
        <?php include 'public/pages/components/footer.php'; ?>
    </div>
</body>
<script src="/public/assets/js/main.js"></script>
<script src="/public/assets/js/theme-swap.js"></script>
</html>
