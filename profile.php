<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<?php $user = getUserById($_SESSION['user']['id'], $pdo); ?>

<section class="profile-page">

    <p> <?php echo $_SESSION['user']['username']; ?></p>

    <div class="profile-image">
        <?php if (isLoggedIn()) : ?>
            <img src="<?= 'app/users/images/' . $user['profileimage'] ?>" alt="Profile-image">
        <?php endif; ?>
    </div>

    <div class="biography-profile-page">
        <?php if (isLoggedIn()) : ?>
            <p><?php echo $user['biography']; ?></p>
        <?php endif; ?>
    </div>


    <a href="settings.php">Edit Profile</a>

    <!-- ADD REST OF PAGE FOR PHOTOS I HAVE UPLOADED -->

</section>




<?php require __DIR__ . '/views/footer.php'; ?>