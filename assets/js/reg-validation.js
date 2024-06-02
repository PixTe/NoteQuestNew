document.getElementById('register-form').addEventListener('submit', function(event) {
    event.preventDefault();
    let isValid = true;

    // Очистка предыдущих ошибок
    clearErrors();

    // Валидация имени пользователя
    const username = document.getElementById('username').value.trim();
    if (username === '') {
        showError('username', 'Имя пользователя не может быть пустым');
        isValid = false;
    } else if (username.length < 3) {
        showError('username', 'Имя пользователя должно содержать минимум 3 символа');
        isValid = false;
    } else if (!isValidUsername(username)) {
        showError('username', 'Имя пользователя должно содержать только латинские буквы');
        isValid = false;
    }

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
    } else if (password.length < 8) {
        showError('password', 'Пароль должен содержать минимум 8 символов');
        isValid = false;
    }

    // Валидация повторного пароля
    const reppassword = document.getElementById('reppassword').value.trim();
    if (reppassword === '') {
        showError('reppassword', 'Повторный пароль не может быть пустым');
        isValid = false;
    } else if (password !== reppassword) {
        showError('reppassword', 'Пароли не совпадают');
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
                if (data.message.includes('Пользователь с таким именем')) {
                    showError('username', data.message);
                } else if (data.message.includes('Пользователь с таким email')) {
                    showError('email', data.message);
                } else {
                    alert(data.message); // Обработка других ошибок
                }
            } else {
                alert('Регистрация прошла успешно!');
                window.location.href = data.redirect; //заменить нахостинге на соответсвующий путь
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

function isValidUsername(username) {
    // Регулярное выражение для проверки имени пользователя (только латинские буквы)
    const usernamePattern = /^[a-zA-Z]+$/;
    return usernamePattern.test(username);
}
