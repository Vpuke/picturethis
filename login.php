<?php require __DIR__ . '/views/header.php'; ?>

<article>

    <h1>Login</h1>

    <form action="app/users/login.php" method="post">

        <div class="login-information">
            <label for="email">Username:</label>
            <input class="input-field-login" type="username" name="username" id="username" placeholder="Enter Username" required>
        </div>

        <div class="login-information">
            <label for="password">Password:</label>
            <input class="input-field-login" type="password" name="password" id="password" placeholder="Enter Password" required>
        </div>

        <button type="submit" class="submit-button-login">Login</button>
        <p>Don't have an account? Sign up <a href="/registeruser.php">here</a></p>
        <?php if (isset($_SESSION['message'])) : ?>
            <p><?php echo $_SESSION['message']; ?></p>
        <?php endif; ?>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>