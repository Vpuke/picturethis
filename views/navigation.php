<?php if (isLoggedIn()) : ?>

    <nav>
        <ul>
            <li class="nav-item">
                <a class="nav-link<?php echo $_SERVER['SCRIPT_NAME'] === '/settings.php' ? 'active' : ''; ?>" href="/settings.php"><i class="fas fa-cog"></i></a>
            </li><!-- /nav-item -->
            <li class="nav-item">
                <a class="navbar-brand" href="/index.php"><?php echo $config['title']; ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/app/users/logout.php"><i class="fas fa-sign-out-alt"></i></a>
            </li><!-- /nav-item -->
        </ul><!-- /navbar-nav -->
    </nav><!-- /navbar -->
<?php else : ?>

    <nav class="navbar">
        <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>
    </nav>

<?php endif; ?>