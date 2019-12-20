<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>



<section class="profile-page">

    <p>Profile page - <?php echo $_SESSION['user']['username']; ?></p>

    <div class="profile-image">

        <img src="<?= 'app/users/images/' . $_SESSION['user']['profileimage'] ?>" alt="Profile-image">

    </div>





</section>




<?php require __DIR__ . '/views/footer.php'; ?>