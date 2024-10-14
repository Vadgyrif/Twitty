<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
</head>
<body>

    <div class="container">

        <div class="form__container">
            <h1>Реєстрація</h1>
            <form class="form" action="/register" method="POST">
                <label for="username">Ім'я користувача:</label>
                <input type="text" name="username" required>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <label for="password">Пароль:</label>
                <input type="password" name="password" required>
                <button type="submit">Зареєструватися</button>
            </form>
            <a href="/login"> <span> Вже маєте обліковий запис?  </span> Увійдіть тут.</a>

        </div>

    </div>
</body>
</html>
