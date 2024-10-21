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
                <div class="user__name" >Привіт, <?php echo htmlspecialchars($user['username']); ?>!</div>
                <div class="user__email"> <?php echo htmlspecialchars($user['email'])?> </div>
                <div class="user__bio"> <?php echo htmlspecialchars($user['bio'] ?? 'Біографія не заповнена');?> </div>
                <div class="birthdate"><?= !empty($user['birthdate']) ? htmlspecialchars(date('d.m.Y', strtotime($user['birthdate']))) : 'Дата народження не вказана'; ?></div>

                <a class="user__edit_a" href="/profedit">Заповнити/оновити профіль</a>
            </div>

            
            <?php if (!empty($users)): ?>
                <div class="friends">
                    <div class="friends__title">Друзі?</div>
                    <?php foreach ($users as $user): ?>
                        <!-- Перевіряємо, чи не є користувач поточним залогіненим -->
                        <?php if ($user['id'] == $_SESSION['user_id']) continue; ?>
                        
                        <div class="user-profile">
                            <a href="/user/<?= htmlspecialchars($tweet['user_id']); ?>">
                                <img class="user_img" src="<?= htmlspecialchars($user['avatar']) ?>" alt="" class="img">
                            </a>
                            <a href="/user/<?= $user['id']; ?>"><?= $user['username']; ?></a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No users found.</p>
                <?php endif; ?>
                </div>


        </div>

        <div class="main">
            <div class="twitts">
                <?php if (count($twitts) > 0): ?>
                    <ul>
                        <?php foreach ($twitts as $twitt): ?>
                            <li>
                            <div class="twitt">
                                <div class="action__with__twitt">
                                    <form action="/twitt/delete" method="POST" style="display:inline">
                                        <input type="hidden" name="twitt_id" value="<?php echo $twitt['id']; ?>">
                                        <button type="submit" class="delete">Delete</button>
                                    </form>
                                    <form action="/twitt/edit" method="GET" style="display:inline">
                                        <div class="fake__button"></div>
                                        <input type="hidden" name="twitt_id" value="<?php echo $twitt['id']; ?>">
                                    </form>

                                    <button class="edit-btn" data-id="<?php echo $twitt['id']; ?>">Edit</button>
                                </div>
            
                                <form class="edit__form" id="edit-form-<?php echo $twitt['id']; ?>" style="display:none;">
                                    <textarea class="edit__twitt_textarea" id="edit-twitt-<?php echo $twitt['id']; ?>"><?php echo htmlspecialchars($twitt['twitt']); ?></textarea>
                                    <button type="button" onclick="saveTwitt(<?php echo $twitt['id']; ?>)">Save</button>
                                </form>
                                    <?php if (!empty($twitt['image'])): ?>
                                        <img src="<?= htmlspecialchars($twitt['image']) ?>" alt="Фото">
                                    <?php endif; ?>
                                    <p class="twitt__content" id="tweet-content-<?php echo $twitt['id']; ?>"><?php echo htmlspecialchars($twitt['twitt']); ?></p>
                                    <div class="created">
                                        <small class="created_at">
                                            (<?= htmlspecialchars((new DateTime($twitt['created_at']))->format('H:i, d M Y')); ?>)
                                        </small>
                                    </div>
                                </div>
                        </li>
                        
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>У вас немає твітів.</p>
                <?php endif; ?>
            </div>
            <div class="add__new__twitt">
                <form action="/twitt" enctype="multipart/form-data" method="POST">
                    <div class="textarea__container">
                        <textarea name="twitt" class="twitt__textarea" id="twittTextarea" required placeholder="Що у вас на думці?"></textarea>
                        <label for="image" class="upload-icon">
                            <img src="/public/image/pngwing.com.png" class="alya__img" alt="">
                        </label>
                        <input type="file" name="image" id="image">
                    </div>   
                    <div class="submit__container">
                        <span id="charCounter">300</span>
                        <button type="submit" disabled >Поділитися</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <script src="/js/editTwitt.js" ></script>

</body>
</html>
