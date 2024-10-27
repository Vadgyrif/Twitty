

<header class="header_main">
    <div class="header__container">
        <div class="header__left">
            <a href="/" class="home">HOME</a>
            
            <?php if(isset($_SESSION['user_id'])): ?>
            <a href="/profile" class="profile">Мій Профіль</a>
        </div>
        <div class="header__right">
                <ul>
                    <li><a href="/logout" class="logout">Logout</a></li>  
                </ul> 
            <?php else: ?>
                <ul>
                    <li><a href="/register" class="register">Register</a></li>
                    <li><a href="/login" class="login">Login</a></li>
                </ul>
        </div>
    </div>
    <?php endif?>
    

</header>