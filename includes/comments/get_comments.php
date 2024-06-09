<?php
require_once '../check_session.php';
require_once '../connection.php';

if (isset($_GET['lesson_id'])) {
    $lesson_id = intval($_GET['lesson_id']);
    
    try {
        $pdo = pdo();
        $stmt = $pdo->prepare("SELECT comments.*, users.username, users.avatar, users.role
                                    FROM comments
                                    JOIN users ON comments.user_id = users.id
                                    WHERE comments.lesson_id = :lesson_id
                                    ORDER BY comments.created_at DESC
                                    ");
        $stmt->bindParam(':lesson_id', $lesson_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($comments as $comment) {
            echo '<div class="comment">';
            echo '<div class="avatar-name">';
            echo '<img src="/public/assets/media/avatars/' . htmlspecialchars($comment['avatar']) . '" alt="Avatar" class="avatar">'; 
            echo '<p><strong>' . htmlspecialchars($comment['username']) . '</strong>';
            // Добавляем отличительный знак для модераторов
            if ($comment['role'] === 'moderator') {
                echo ' <span class="moderator-badge"> модератор</span>';
            }
            echo '</p></div>';
            echo '<p>' . htmlspecialchars($comment['content']) . '</p>';
            // Преобразование формата времени
            $timestamp = strtotime($comment['created_at']);
            $formatted_time = date('Написал(-а) в H:i d.m.Y', $timestamp);
            echo '<p><small>' . $formatted_time . '</small></p>';
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'moderator') {
                echo '<button class="delete-comment" data-comment-id="' . $comment['id'] . '">Удалить</button>';
            }


            echo '</div>';
        }
        
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Lesson ID not provided.';
}
