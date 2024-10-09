<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Профіль</title>
</head>
<body>
    
    <div class="user__info">
        <?php if (!empty($user['image'])): ?>
            <img src="<?= htmlspecialchars($user['image']) ?>" alt="Фото">
        <?php endif; ?>
        <div class="user__info"></div>
        <h2>Привіт, <?php echo htmlspecialchars($user['username']); ?>!</h2>
        <p class="email"> <?php echo htmlspecialchars($user['email'])?> </p>
        <p class="description"> <?php echo htmlspecialchars($user['bio'])?> </p>
        <div class="birthdate"> <?php echo htmlspecialchars($user['birthdate'])?></div>
        <a href="/profile/edit">Заповнити/оновити профіль</a>

    </div>

    
    <h2>Напишіть новий твіт:</h2>
    <form action="/twitt" enctype="multipart/form-data" method="POST">
        <label for="image">Додати фото</label>
        <input type="file" name="image" id="image">
        <textarea name="twitt" required placeholder="Що у вас на думці?"></textarea>
        <button type="submit">Відправити</button>
    </form>

    <h2>Ваші твіти:</h2>
    <?php if (count($twitts) > 0): ?>
        <ul>
            <?php foreach ($twitts as $twitt): ?>
                <li>
                    <form action="/twitt/delete" method="POST" style="display:inline">
                        <input type="hidden" name="twitt_id" value="<?php echo $twitt['id']; ?>">
                        <button type="submit" class="delete">Delete</button>
                    </form>
                    <form action="/twitt/edit" method="GET" style="display:inline">
                        <input type="hidden" name="twitt_id" value="<?php echo $twitt['id']; ?>">
                    </form>

                    <button class="edit-btn" data-id="<?php echo $twitt['id']; ?>">Edit</button>

  
                    <form id="edit-form-<?php echo $twitt['id']; ?>" style="display:none;">
                        <textarea id="edit-twitt-<?php echo $twitt['id']; ?>"><?php echo htmlspecialchars($twitt['twitt']); ?></textarea>
                        <button type="button" onclick="saveTwitt(<?php echo $twitt['id']; ?>)">Save</button>
                    </form>
                    <div class="twitt">
                        <?php if (!empty($twitt['image'])): ?>
                            <img src="<?= htmlspecialchars($twitt['image']) ?>" alt="Фото">
                        <?php endif; ?>
                        <p id="tweet-content-<?php echo $twitt['id']; ?>"><?php echo htmlspecialchars($twitt['twitt']); ?></p>
                        <small>(<?php echo $twitt['created_at']; ?>)</small>
                    </div>
            </li>
            <br>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>У вас немає твітів.</p>
    <?php endif; ?>


        <script src="/js/editTwitt.js" ></script>

</body>
</html>
