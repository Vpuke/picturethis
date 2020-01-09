<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<?php $user = getUserById($_SESSION['user']['id'], $pdo); ?>
<?php $id = (int) $_SESSION['user']['id']; ?>

<section class="settings-page">
    <h2>Settings</h2>

    <div class="profile-image-upload">
        <?php if (isLoggedIn()) : ?>
            <img class="profile-image-src" src="<?= 'app/users/images/' . $user['profileimage'] ?>" alt="Profile-image">
        <?php endif; ?>
    </div>

    <form class="profile-image" action="app/users/profileimage.php" method="post" enctype="multipart/form-data">
        <div class="form-information">
            <label class="general-label" for="profile-image">Choose your profile image</label>
            <input class="input-field-information" type="file" accept="image/jpeg, image/png" name="profileimage" required>
            <button class="submit-button" type="submit" name="button">Upload photo</button>
        </div>
    </form>

    <form class="user-settings" action="app/users/biography.php" method="post" enctype="multipart/form-data">
        <div class="form-information">
            <label class="general-label" for="biography">Write some information about yourself</label>
            <textarea class="biography-field" name="biography" placeholder="<?= $user['biography'] ?>" cols="30" rows="10"></textarea>
            <label class="general-label" for="name">Change your Name</label>
            <input class="input-field-information" type="text" name="edit-name" placeholder="<?= $user['fullname'] ?>">
            <label class="general-label" for="username">Change your Username</label>
            <input class="input-field-information" type="text" name="edit-username" placeholder="<?= $user['username'] ?>">

            <button class="submit-button" type="submit" name="button">Save your changes</button>
        </div>
    </form>

    <form action="app/users/update-email-settings.php" class="user-settings" method="post" enctype="multipart/form-data">
        <div class="form-information">
            <label class="general-label" for="email">Change your email</label>
            <br>
            <input class="input-field-information" type="email" name="current-email" placeholder="<?= $user['email'] ?>">
            <br>
            <input class="input-field-information" type="email" name="new-email" placeholder="New Email">
            <br>
            <input class="input-field-information" type="email" name="repeat-email" placeholder="Repeat New Email">
            <br>
            <button class="submit-button" type="submit">Save changes</button>
        </div>
    </form>

    <form action="app/users/update-password-settings.php" class="user-settings" method="post" enctype="multipart/form-data">
        <div class="form-information">
            <label class="general-label" for="password">Change your password</label>
            <br>
            <input class="input-field-information" type="password" name="current-password" placeholder="Current Password">
            <br>
            <input class="input-field-information" type="password" name="new-password" placeholder="New Password">
            <br>
            <input class="input-field-information" type="password" name="repeat-password" placeholder="Repeat New Password">
            <br>
            <button class="submit-button" type="submit">Save changes</button>
        </div>
    </form>

    <?php if (isset($_SESSION['message'])) : ?>
        <p><?php echo $_SESSION['message'];
            unset($_SESSION['message']); ?></p>
    <?php endif; ?>


</section>

<?php require __DIR__ . '/views/footer.php'; ?>