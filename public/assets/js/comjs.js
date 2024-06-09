$(document).ready(function() {
    var isUserLoggedIn = window.isUserLoggedIn;
    var lessonId = $('#lesson_id').val();
    $('#commentForm').on('submit', function(e) {
        e.preventDefault();

        if (!isUserLoggedIn) {
            alert("Вы должны войти в систему, чтобы оставить комментарий.");
            return;
        }

        $.ajax({
            type: 'POST',
            url: '/includes/comments/add_comments.php',
            data: $(this).serialize() + '&lesson_id=' + lessonId, // добавляем lesson_id к данным формы
            success: function(response) {
                $('#content').val(''); // Очистить поле ввода комментария
                loadComments(); // Перезагрузить список комментариев
            },
            error: function(xhr, status, error) {
                console.error("Ошибка при добавлении комментария:", error);
            }
        });
    });

    function loadComments() {
        $.ajax({
            type: 'GET',
            url: '/includes/comments/get_comments.php',
            data: { lesson_id: lessonId },
            success: function(response) {
                $('#commentsContainer').html(response);
            },
            error: function(xhr, status, error) {
                console.error("Ошибка при загрузке комментариев:", error);
            }
        });
    }

    $(document).on('click', '.delete-comment', function() {
        var commentId = $(this).data('comment-id');
        console.log(commentId);
        $.ajax({
            url: '/includes/comments/delete_comment.php',
            type: 'POST',
            data: { id: commentId },
            success: function(response) {
                // Обработка успешного удаления комментария
                loadComments();
            },
            error: function(xhr, status, error) {
                // Обработка ошибки удаления комментария
                alert('Ошибка при удалении комментария: ' + error);
            }
        });
    });
    loadComments(); // Загрузить комментарии при загрузке страницы
});