<?php
// session_start();

// Функция для записи логов
function logError($message) {
    // $logFile = 'logs/errors/server-err.txt'; 
    // $timestamp = date('Y-m-d H:i:s');
    // file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

// Обработчик ошибок
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    $message = "Ошибка: [$errno] $errstr в $errfile на строке $errline";
    logError($message);
    return true;
});

// Обработчик непойманных исключений
set_exception_handler(function ($exception) {
    $message = "Непойманное исключение: " . $exception->getMessage() . " в " . $exception->getFile() . " на строке " . $exception->getLine();
    logError($message);
});

// Обработчик фатальных ошибок
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== NULL) {
        $message = "Фатальная ошибка: {$error['message']} в {$error['file']} на строке {$error['line']}";
        logError($message);
    }
});

function pdo(): PDO
{
    static $pdo;

    if (!$pdo) {
        $config = include './config/config.php';
        //DB Connect
        try {
            $dsn = 'mysql:dbname=' . $config['db_name'] . ';host=' . $config['db_host'];
            $pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }
    return $pdo;
}
?>
