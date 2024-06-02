<?php
session_start();
require_once 'connection.php';

function logMessage($message, $type = 'INFO') {
    $logFile = '../logs/auth/signin-log.txt';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] [$type] $message\n", FILE_APPEND);
}

logMessage('Начало выполнения скрипта входа');

try {
    logMessage('Проверка наличия пользователя с таким email: ' . $_POST['email']);
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `email` = :email");
    $stmt->execute(['email' => $_POST['email']]);
    logMessage('Запрос к БД выполнен: SELECT * FROM `users` WHERE `email` =' . $_POST['email']);

    if ($stmt->rowCount() == 0) {
        logMessage('Пользователь с таким email не существует: ' . $_POST['email']);
        echo json_encode(['status' => 'error', 'message' => 'Пользователя с таким email не зарегистрировано']);
        exit;
    } else {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($_POST['password'], $user['password_hash'])) {
            logMessage('Пароль верный для пользователя: ' . $user['email']);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $stmt = pdo()->prepare("UPDATE `users` SET `session_status` = 1 WHERE `email` = :email");
            $stmt->execute(['email' => $_POST['email']]);
            logMessage('Обновление session_status для пользователя: ' . $_POST['email']);

            $username = $user['username'];
            logMessage('Пользователь авторизован: ' . $username);

            echo json_encode(['status' => 'success', 'message' => 'Авторизация прошла успешно', 'redirect' => '/' . $username]);
            exit;
        } else {
            logMessage('Неверный пароль для пользователя: ' . $user['email']);
            echo json_encode(['status' => 'error', 'message' => 'Неверный email или пароль']);
            exit;
        }
    }
} catch (Exception $e) {
    logMessage('Ошибка: ' . $e->getMessage(), 'ERROR');
    echo json_encode(['status' => 'error', 'message' => 'Произошла ошибка при входе. Попробуйте позже.']);
    exit;
}
?>
