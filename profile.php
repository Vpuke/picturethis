<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>



<section class="profile-page">

    <p> <?php echo $_SESSION['user']['username']; ?> - Profile</p>

    <div class="profile-image">
        <img src="<?= 'app/users/images/' . $_SESSION['user']['profileimage'] ?>" alt="Profile-image">
    </div>

    <div class="biography-profile-page">
        <h3>Biography</h3>
        <p><?php echo ("{$_SESSION['user']['biography']}"); ?></p>
    </div>




    <a href="settings.php">Edit Profile</a>
</section>




<?php require __DIR__ . '/views/footer.php'; ?>