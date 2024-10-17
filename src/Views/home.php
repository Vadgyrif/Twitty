
    <div class="container">

        <div class="main">

            <div class="twitts">
            <?php if (count($tweets) > 0): ?>
                    <ul>
                   <?php foreach ($tweets as $tweet): ?>
    <li class="twitt">
        <div class="twitt__user_info">
            <div class="user__avatar">
                <a href="/user/<?= htmlspecialchars($tweet['user_id']); ?>">
                    <img class="user_img" src="<?= htmlspecialchars($user['avatar']) ?>" alt="" class="img">
                </a>
            </div>
            <div class="twitt__user_text">
                <a href="/user/<?= htmlspecialchars($tweet['user_id']); ?>">
                    <?= htmlspecialchars($tweet['username']); ?>
                </a>
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



