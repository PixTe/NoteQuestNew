<?php
session_start();
    require_once 'includes/connection.php';

    $is_logged_in = isset($_SESSION['user_id']);
    
    if($is_logged_in){
        try{
            $pdo = pdo();
            $user_id = $_SESSION['user_id'];

            $stmt = $pdo->prepare("SELECT username FROM users WHERE id = :user_id");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $username = $user['username'];
            } else {
                // Обработка случая, если пользователь не найден
                $is_logged_in = false;
            }
        }catch(PDOException $e){
            echo "Error:" . $e->getMessage();
        }
    }

?>

<header class="navbar">
    <div class="navbar-container">
        <a href="/" class="navbar-logo">NoteQuest</a>
        <nav class="navbar-nav" id="navbar-nav">
            <ul class="navbar-menu">
                <li class="navbar-item"><a href="/" class="navbar-link">Главная</a></li>
                <li class="navbar-item"><a href="/classes" class="navbar-link">Уроки</a></li>
                <li class="navbar-item"><a href="/about" class="navbar-link">О сайте</a></li>
                <li class="modal-link" ><a id="openMenu" class="navbar-link ">Menu</a></li>
            </ul>
        </nav>
        <div class="navbar-auth">
            <button id="theme-toggle" class="theme-button">
            <svg class="theme-icon" width="64px" height="64px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.12"></g><g id="SVGRepo_iconCarrier"> <title>contrast [#907]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-180.000000, -4199.000000)" > <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M126,4049 C126,4044.589 129.589,4041 134,4041 L134,4057 C129.589,4057 126,4053.411 126,4049 M134,4039 C128.477,4039 124,4043.477 124,4049 C124,4054.523 128.477,4059 134,4059 C139.523,4059 144,4054.523 144,4049 C144,4043.477 139.523,4039 134,4039" id="contrast-[#907]"> </path> </g> </g> </g> </g></svg>
            </button>
            <?php if ($is_logged_in): ?>
                <a href="../includes/logout.php" class="navbar-button">Выйти</a>
                <a href="/<?php echo htmlspecialchars($username)?>" class="navbar-button">Профиль</a>
            <?php else: ?>
                <a href="/login" class="navbar-button">Вход</a>
            <?php endif; ?>
        </div>
    </div>
</header>
    <!-- Модальное меню -->
    <div id="modalMenu" class="modal-menu">
        <!-- Крестик для закрытия меню -->
        <button id="closeMenu" class="close-button">×</button>
        <!-- Ссылки по центру -->
        <div class="menu-content">
            <a href="/classes">Уроки</a>
            <a href="/about">О нас</a>
            <?php if ($is_logged_in): ?>
                <a href="../includes/logout.php">Выйти</a>
                <a href="/<?php echo htmlspecialchars($username)?>">Профиль</a>
            <?php else: ?>
                <a href="/login">Вход</a>
            <?php endif; ?>
        </div>
    </div>