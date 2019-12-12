<?php require __DIR__ . '/views/header.php'; ?>

<?php if (isset($_SESSION['user'])) : ?>
    <p>Welcome, <?php echo $_SESSION['user']['username']; ?>!</p>
<?php else : ?>
    <article>

        <h1>A new way to access your friends photo feed</h1>

        <h2>Login or sign up!</h2>

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
<?php endif; ?>


<?php require __DIR__ . '/views/footer.php'; ?>