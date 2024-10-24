<<<<<<< HEAD
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Головна сторінка</title>
</head>
<body>
    <h3>Стрічка твітів</h3>

    <?php if (isset($_SESSION['user_id'])): ?>
        <form action="/twitt" method="POST">
            <textarea name="twitt" required placeholder="Ваш твіт" maxlength="300"></textarea>
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
=======

    <div class="container">

        <div class="main">

            <div class="twitts">
            <?php if (count($tweets) > 0): ?>
                    <ul>
                   <?php foreach ($tweets as $tweet): ?>
    <li class="twitt">
        <div class="twitt__user_info">
            
            <div class="twitt__user_text">
                <a href="/user/<?= htmlspecialchars($tweet['user_id']); ?>">
                    <?= htmlspecialchars($tweet['username']); ?>
                </a>
                <?php if (!empty($tweet['image'])): ?>
                    <div class="twitt__image">
                        <img class="twitt-image" src="<?= htmlspecialchars($tweet['image']) ?>" alt="Зображення твіту">
                    </div>
                <?php endif; ?>

                <div class="twitt__content">
                    <?= htmlspecialchars($tweet['twitt']); ?>
                </div>
                <small class="birthdate">
                    (<?= htmlspecialchars((new DateTime($tweet['created_at']))->format('H:i, d M Y')); ?>)
                </small>
            </div>
        </div>
    </li>
<?php endforeach; ?>

            <?php else: ?>
                <p>Немає жодного твіту.</p>
            <?php endif; ?>
            </div>


>>>>>>> 4986444 (twitty 1.5)

