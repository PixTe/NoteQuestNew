<?php
session_start();
require_once 'includes/connection.php';

// Проверяем, авторизован ли пользователь
$is_logged_in = isset($_SESSION['user_id']);

// Если пользователь не авторизован, перенаправляем на страницу входа
if (!$is_logged_in) {
    header('Location:/login');
    exit;
}

// Получаем информацию о пользователе из базы данных
$user_id = $_SESSION['user_id'];
$stmt = pdo()->prepare("SELECT `username` FROM `users` WHERE `id` = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Если пользователь не найден, выводим сообщение об ошибке
if (!$user) {
    $error_message = "Пользователь с ID $user_id не найден.";
    logError($error_message);
    include('404.php');
    exit;
}

$username = $_GET['username'] ?? null;

if (!$username || $username !== $user['username']) {
    include('404.php');
    exit;
}

// Иначе, получаем имя пользователя
// $username = $user['username'];
?>

<!DOCTYPE html>
<html lang="ru">
<?php include 'components/head.php'; ?>
<link rel="stylesheet" id="theme-style" type="text/css" href="assets/css/style-theme.css">
<title>Профиль пользователя - <?php echo htmlspecialchars($username); ?></title>
<body>
    <div class="layout">
        <?php include 'components/navbar.php'; ?>
        <main class="user-page">
            <div class="user-block">
                <h1>Здравструйте, <?php echo htmlspecialchars($username)?></h1>
                
            </div>
        </main>
        <?php include 'components/footer.php'; ?>
    </div>
</body>
<script src="assets/js/main.js"></script>
<script src="assets/js/theme-swap.js"></script>
</html>
