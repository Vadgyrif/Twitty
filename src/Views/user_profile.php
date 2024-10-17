<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Профіль</title>
</head>
<body>
    
    <div class="container">
        <div class="aside">
            <div class="user__info">
                <div class="user__avatar">
                    <?php if (!empty($user['image'])): ?>
                        <img class="img" <?= htmlspecialchars($user['image']) ?>" alt="Фото">
                    <?php endif; ?>
                </div>
                <div class="user__name" > <?php echo htmlspecialchars($user['username']); ?>!</div>
                <div class="user__email"> <?php echo htmlspecialchars($user['email'])?> </div>
                <div class="user__bio"> <?php echo htmlspecialchars($user['bio'] ?? 'Біографія не заповнена');?> </div>
                <div class="birthdate"><?= !empty($user['birthdate']) ? htmlspecialchars(date('d.m.Y', strtotime($user['birthdate']))) : 'Дата народження не вказана'; ?></div>
            </div>
        </div>

        <div class="main">
            <div class="twitts">
                <?php if (count($twitts) > 0): ?>
                    <ul>
                        <?php foreach ($twitts as $twitt): ?>
                            <li>
                            <div class="twitt">
            
                                <form class="edit__form" id="edit-form-<?php echo $twitt['id']; ?>" style="display:none;">
                                    <textarea class="edit__twitt_textarea" id="edit-twitt-<?php echo $twitt['id']; ?>"><?php echo htmlspecialchars($twitt['twitt']); ?></textarea>
                                    <button type="button" onclick="saveTwitt(<?php echo $twitt['id']; ?>)">Save</button>
                                </form>
                                    <?php if (!empty($twitt['image'])): ?>
                                        <img src="<?= htmlspecialchars($twitt['image']) ?>" alt="Фото">
                                    <?php endif; ?>
                                    <p class="twitt__content" id="tweet-content-<?php echo $twitt['id']; ?>"><?php echo htmlspecialchars($twitt['twitt']); ?></p>
                                    <small class="birthdate">(<?php echo $twitt['created_at']; ?>)</small>
                                </div>
                        </li>
                        
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>У вас немає твітів.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

        <script src="/js/editTwitt.js" ></script>

</body>
</html>
