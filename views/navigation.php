<?php if (isLoggedIn()) : ?>

    <nav class="navbar">
        <a class="navbar-brand" href="/index.php"><?php echo $config['title']; ?></a>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Feed</a>
            </li><!-- /nav-item -->

            <li class="nav-item">
                <a class="nav-link<?php echo $_SERVER['SCRIPT_NAME'] === '/settings.php' ? 'active' : ''; ?>" href="/settings.php">Settings</a>
            </li><!-- /nav-item -->

            <li class="nav-item">
                <a class="nav-link" href="/app/users/logout.php">Logout</a>
            </li><!-- /nav-item -->
        </ul><!-- /navbar-nav -->
    </nav><!-- /navbar -->
<?php else : ?>

    <nav class="navbar">
        <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>

    <?php endif; ?>