<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Профіль</title>
</head>
<body>
    <h1>Привіт, <?php echo htmlspecialchars($user['username']); ?>!</h1>
    
    <h2>Напишіть новий твіт:</h2>
    <form action="/twitt" method="POST">
        <textarea name="twitt" required></textarea>
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

                    <p id="tweet-content-<?php echo $twitt['id']; ?>"><?php echo htmlspecialchars($twitt['twitt']); ?></p>
                <small>(<?php echo $twitt['created_at']; ?>)</small>
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
