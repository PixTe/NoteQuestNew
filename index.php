<?php
// Определение страницы по умолчанию
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Подключение к базе данных и обработка ошибок
try {
    include 'config/config.php';
    $dsn = 'mysql:host=127.0.0.1;dbname=notequest_db;charset=utf8';
    $username = 'root';
    $password = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, $username, $password, $options);

    // Ваш код работы с базой данных здесь
} catch (PDOException $e) {
    error_log("Database Connection Error: " . $e->getMessage(), 0);
    // В случае ошибки подключения к базе данных, включаем страницу 500
    include 'public/pages/500.php';
    exit();
}

// Проверка для страницы урока
if ($page === 'lesson' && isset($_GET['id'])) {
    $lesson_id = $_GET['id'];
    // Подключаем файл lesson.html из папки lessons
    $file = 'public/pages/lessons/lesson.html';
    includeFileOr404($file);
    exit(); // Прерываем выполнение скрипта после подключения страницы
}

// Список допустимых страниц
$valid_pages = [
    'home',
    'classes',
    'auth/register',
    'auth/login',
    'user',
    'about'
    ];

// Проверка наличия запрошенной страницы в списке допустимых или на существование файла
if (in_array($page, $valid_pages) && file_exists('public/pages/' . $page . '.html')) {
    // Подключение запрошенной страницы
    include 'public/pages/' . $page . '.html';
    } else {
    // Если страница не найдена, подключаем страницу 404
    include 'public/pages/404.php';
    }

// Функция для подключения файла или страницы 404
function includeFileOr404($file) {
    if (file_exists($file)) {
        include $file;
    } else {
        include 'public/pages/404.php';
    }
}
?>
