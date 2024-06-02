<?php
session_start();
require_once 'connection.php';

function logMessage($message, $type = 'INFO') {
    $logFile = '../logs/auth/reg-log.txt';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] [$type] $message\n", FILE_APPEND);
}

logMessage('Начало выполнения скрипта регистрации');

try {

    // Проверка существования имени пользователя
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `username` = :username");
    $stmt->execute(['username' => $_POST['username']]);
    logMessage('Запрос к БД выполнен: SELECT * FROM `users` WHERE `username` = ' . $_POST['username']);

    if ($stmt->rowCount() > 0) {
        logMessage('Пользователь с таким именем уже существует: ' . $_POST['username']);
        echo json_encode(['status' => 'error', 'message' => 'Пользователь с таким именем уже существует']);
        exit;
    }

    // Проверка существования электронной почты
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `email` = :email");
    $stmt->execute(['email' => $_POST['email']]);
    logMessage('Запрос к БД выполнен: SELECT * FROM `users` WHERE `email` = ' . $_POST['email']);

    if ($stmt->rowCount() > 0) {
        logMessage('Пользователь с таким email уже существует: ' . $_POST['email']);
        echo json_encode(['status' => 'error', 'message' => 'Пользователь с таким email уже существует']);
        exit;
    }

    // Вставка нового пользователя
    logMessage('Добавление пользователя: ' . $_POST['username']);
    $stmt = pdo()->prepare("INSERT INTO `users` (`username`, `email`, `password_hash`) VALUES (:username, :email, :password_hash)");
    $stmt->execute([
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password_hash' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    ]);
    logMessage('Пользователь успешно зарегистрирован: ' . $_POST['username']);
    echo json_encode(['status' => 'success', 'message' => 'Регистрация прошла успешно', 'redirect' => '/login']);
    exit;

} catch (Exception $e) {
    logMessage('Ошибка: ' . $e->getMessage(), 'ERROR');
    echo json_encode(['status' => 'error', 'message' => 'Произошла ошибка при регистрации. Попробуйте позже.']);
    exit;
}
?>
