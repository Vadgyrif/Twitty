

<header class="header_main">
    <a href="/" class="home">HOME</a>
    
    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="/profile" class="profile">Мій Профіль</a>
        <ul>
            <li><a href="/logout" class="logout">Logout</a></li>  
        </ul>      
    <?php else: ?>
        <ul>
            <li><a href="/register" class="register">Register</a></li>
            <li><a href="/login" class="login">Login</a></li>
        </ul>
    <?php endif?>
    

</header>