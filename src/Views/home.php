
    <div class="container">

        <div class="main">

            <div class="twitts">
            <?php if (count($tweets) > 0): ?>
                    <ul>
                    <?php foreach ($tweets as $tweet): ?>
                            <li class="twitt">
                                <div class="twitt__user_info">
                                    <div class="user__avatar">
                                        <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="" class="img">
                                    </div>
                                    <strong><?php echo htmlspecialchars($tweet['username']); ?></strong>: 
                                    <div class="twitt__content"><?php echo htmlspecialchars($tweet['twitt']); ?> </div>
                                    <small class="birthdate" >(<?php echo $tweet['created_at']; ?>)</small>
                                </div>
                                </li> 
                            
                    <?php endforeach; ?>
                    </ul>
            <?php else: ?>
                <p>Немає жодного твіту.</p>
            <?php endif; ?>
            </div>

           <!-- <div class="add__new__twitts">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form action="/twitt" enctype="multipart/form-data" method="POST">
                    <label for="image">Додати фото</label>
                    <input type="file" name="image" id="image">
                        <textarea name="twitt" required placeholder="Що у вас на думці?" maxlength="300"></textarea>
                    <div class="submit__container">
                        <button type="submit">Відправити</button>
                    </div>
                    </form> -->
                <?php else: ?>
                    <p>Вам потрібно <a href="/login">увійти</a>, щоб писати твіти.</p>
                <?php endif; ?>
            </div>
        </div>

