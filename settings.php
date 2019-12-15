<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<section class="settings-page">
    <h2>Settings</h2>

    <form class="profile-image" action="#" method="post" enctype="multipart/form-data">
        <div class="form-information">
            <label for="profile-image">Choose your profile photo</label>
            <input class="profile-image-input" type="file" accept="image/jpeg" name="profileimage" required>
            <button class="button-primary" type="submit" name="button">Upload photo</button>
        </div>
    </form>

    <form class="user-settings" action="#" method="post" enctype="multipart/form-data">
        <div class="form-information">
            <label for="biography">Write some information about yourself</label>
            <textarea class="biography-field" name="biography" placeholder="Write some information about yourself" cols="30" rows="10"></textarea>

            <label for="name">Change your Name</label>
            <input type="form-information" type="text" name="edit-name" placeholder="Change your name">

            <label for="username">Change your Username</label>
        </div>
    </form>

</section>




<?php require __DIR__ . '/views/footer.php'; ?>


name
username
confirm with password

submit btn

next form
change email
current,new,repeat

next form change password,
current, new, repeat, submit