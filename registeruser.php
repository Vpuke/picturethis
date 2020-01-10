<?php require __DIR__ . '/views/header.php'; ?>

<section>

    <div class="container-registration">
        <div class="logotype">
            <h1>Picture This</h1>
        </div>

        <h2>Sign up now!</h2>

        <form role="form" method="post" action="app/users/registeruser.php">

            <div class="form-information">
                <label class="general-label" for="name">Full Name</label>
                <input type="text" class="input-field-information" id="fullname" name="fullname" placeholder="Enter your Full Name">
            </div>

            <div class="form-information">
                <label class="general-label" for="username">Username</label>
                <input type="text" class="input-field-information" name="username" placeholder="Enter your Username">
            </div>

            <div class="form-information">
                <label class="general-label" for="email">Email</label>
                <input type="text" class="input-field-information" name="email" placeholder="Enter your Email">
            </div>

            <div class="form-information">
                <label class="general-label" for="password">Password</label>
                <input type="password" class="input-field-information" name="password" placeholder="Enter your Password">
            </div>

            <div class="form-information">
                <label class="general-label" for="password-repeat">Repeat password</label>
                <input type="password" class="input-field-information" name="password-repeat" placeholder="Enter your password again">
            </div>

            <button type="submit-button" class="submit-button">Sign up!</button>

            <p class="account">Already have an account? Sign in <a href="/index.php">here</a></p>

        </form>
    </div>

</section>