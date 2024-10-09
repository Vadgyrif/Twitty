<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Увійти</title>
</head>
<body>
    <h1>Увійти</h1>
    <form action="/login" method="POST">
        <label for="email">Електронна пошта </label>
        <input type="text" name="email" required>
        <label for="password">Пароль:</label>
        <input type="password" name="password" required>
        <button type="submit">Увійти</button>
    </form>
    <a href="/register">Ще немає облікового запису? Зареєструйтеся тут.</a>
</body>
</html>
