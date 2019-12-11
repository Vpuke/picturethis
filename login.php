<?php require __DIR__ . '/views/header.php'; ?>

<article>

    <h1>Login</h1>

    <form action="app/users/login.php" method="post">

        <div class="login-information">
            <label for="email">Email:</label>
            <input class="input-field-login" type="email" name="email" id="email" placeholder="hello@picture.this" required>
        </div>

        <div class="login-information">
            <label for="password">Password:</label>
            <input class="input-field-login" type="password" name="password" id="password" required>
        </div>

        <button type="submit" class="submit-button-login">Login</button>
        <p>Don't have an account? Sign up <a href="/registeruser.php">here</a></p>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>