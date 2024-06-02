document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    let isValid = true;

    // Очистка предыдущих ошибок
    clearErrors();

    // Валидация электронной почты
    const email = document.getElementById('email').value.trim();
    if (email === '') {
        showError('email', 'Электронная почта не может быть пустой');
        isValid = false;
    } else if (!isValidEmail(email)) {
        showError('email', 'Некорректный формат электронной почты');
        isValid = false;
    }

    // Валидация пароля
    const password = document.getElementById('password').value.trim();
    if (password === '') {
        showError('password', 'Пароль не может быть пустым');
        isValid = false;
    }

    if (isValid) {
        // Если клиентская валидация пройдена, отправляем запрос на сервер
        const formData = new FormData(event.target);

        fetch(event.target.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                if (data.message.includes('Пользователя с таким email')) {
                    showError('email', data.message);
                } else if (data.message.includes('Неверный email или пароль')) {
                    showError('password', data.message);
                } else {
                    alert(data.message); // Обработка других ошибок
                }
            } else {
                alert('Авторизация прошла успешно!');
                window.location.href = data.redirect; // Редирект на главную страницу
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
        });
    }
});

function showError(inputId, message) {
    const errorSpan = document.getElementById(inputId + 'Error');
    errorSpan.textContent = message;

    const inputField = document.getElementById(inputId);
    inputField.classList.add('error-border');
}

function clearErrors() {
    const errorSpans = document.querySelectorAll('.error');
    errorSpans.forEach(span => {
        span.textContent = '';
    });

    const inputFields = document.querySelectorAll('.error-border');
    inputFields.forEach(field => {
        field.classList.remove('error-border');
    });
}

function isValidEmail(email) {
    // Простой регулярный выражение для проверки электронной почты
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}
