<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Головна сторінка</title>
</head>
<body>
    <h3>Стрічка твітів</h3>

    <?php if (isset($_SESSION['user_id'])): ?>
        <form action="/twitt" enctype="multipart/form-data" method="POST">
        <label for="image">Додати фото</label>
        <input type="file" name="image" id="image">
            <textarea name="twitt" required placeholder="Що у вас на думці?" maxlength="300"></textarea>
            <button type="submit">Відправити</button>
        </form>
    <?php else: ?>
        <p>Вам потрібно <a href="/login">увійти</a>, щоб писати твіти.</p>
    <?php endif; ?>

    
    <?php if (count($tweets) > 0): ?>
        <ul>
            <?php foreach ($tweets as $tweet): ?>
                <li>
                    <strong><?php echo htmlspecialchars($tweet['username']); ?></strong>: <br>
                    <?php echo htmlspecialchars($tweet['twitt']); ?> <br>
                    <small>(<?php echo $tweet['created_at']; ?>)</small>
                </li> <br> <hr>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Немає жодного твіту.</p>
    <?php endif; ?>
</body>
</html>

