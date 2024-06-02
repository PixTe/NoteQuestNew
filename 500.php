<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 Err</title>
    <style>
        body {
            font-family: 'Comfortaa', 'Arial', sans-serif;
            background-color: #1e1e1e;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color:#ccc;
            text-align: center;
        }

        .error-container {
            background-color: #2A2A2A;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #B96A5A;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #854c41;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <h1>500</h1>
        <p>Внутренняя ошибка сервера.</p>
        <p>Извините за неудобства. Пожалуйста, попробуйте позже.</p>
        <a href="/">Вернуться на главную</a>
    </div>
</body>

</html>
