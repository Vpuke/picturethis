<?php require __DIR__ . '/views/header.php'; ?>

<section>

    <div class="container-registration">
        <h2>Sign up now!</h2>

        <form role="form" method="post" action="app/users/registeruser.php">

            <div class="form-registration">
                <label for="name">Full Name:</label>
                <input type="text" class="input-registration" id="fullname" name="fullname" placeholder="Full Name">
            </div>

            <div class="form-registration">
                <label for="username">Username:</label>
                <input type="text" class="input-registration" name="username" placeholder="Enter your Username">
            </div>

            <div class="form-registration">
                <label for="email">Email:</label>
                <input type="text" class="input-registration" name="email" placeholder="Enter your Email">
            </div>

            <div class="form-registration">
                <label for="password">Password:</label>
                <input type="password" class="input-registration" name="password" placeholder="Enter your Password">
            </div>

            <div class="form-registration">
                <label for="password-repeat">Repeat password:</label>
                <input type="password" class="input-registration" name="password-repeat" placeholder="Enter your password again">
            </div>

            <button type="submit" class="button-registration">Sign up!</button>
            <p>Already have an account? Sign in <a href="/index.php">here</a></p>
            <?php if (isset($_SESSION['message'])) : ?>
                <p><?php echo $_SESSION['message'];
                        unset($_SESSION['message']); ?></p>
            <?php endif; ?>
        </form>
    </div>

</section>
<?php require __DIR__ . '/views/footer.php'; ?>