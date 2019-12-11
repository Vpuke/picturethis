<?php require __DIR__ . '/views/header.php'; ?>

<div class="container-registration">
    <h2>Sign up now!</h2>

    <form role="form" method="post" action="app/users/registeruser.php">

        <div class="form-registration">
            <label for="name">Name:</label>
            <input type="text" class="input-registration" id="name" name="name" placeholder="Enter your first name">
        </div>

        <div class="form-registration">
            <label for="user_name">Username:</label>
            <input type="text" class="input-registration" name="user_name" placeholder="Enter your username">
        </div>

        <div class="form-registration">
            <label for="email">Email:</label>
            <input type="text" class="input-registration" name="email" placeholder="Enter your email">
        </div>

        <div class="form-registration">
            <label for="last-name">Password:</label>
            <input type="text" class="input-registration" name="password" placeholder="Enter your password">
        </div>

        <div class="form-registration">
            <label for="last-name">Repeat password:</label>
            <input type="text" class="input-registration" name="password_repeat" placeholder="Enter your password again">
        </div>

        <button type="submit" class="button-registration">Sign up!</button>
        <p>Already have an account? Sign in <a href="/login.php">here</a></p>
    </form>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>