<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>


<?php $user = getUserById($_SESSION['user']['id'], $pdo); ?>
<?php $id = (int) $_SESSION['user']['id']; ?>
<?php $posts = getPostsByUser($id, $pdo); ?>


<section class="profile-page">

    <p> <?php echo $_SESSION['user']['username']; ?></p>

    <div class="profile-image">
        <?php if (isLoggedIn()) : ?>
            <img class="profile-image-src" src="<?= 'app/users/images/' . $user['profileimage'] ?>" alt="Profile-image">
        <?php endif; ?>
    </div>

    <div class="biography-profile-page">
        <?php if (isLoggedIn()) : ?>
            <p><?php echo $user['biography']; ?></p>
        <?php endif; ?>
    </div>


    <a href="settings.php">Edit Profile</a>

    <!-- Cant print posts on profile page -->

    <?php if (isLoggedIn()) : ?>
        <?php foreach ($posts as $post) : ?>
            <div class="smallPosts">
                <img src="<?= 'app/posts/uploads/' . $post['userId'] . '/' . $post['postImage'] ?>" alt="">
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</section>




<?php require __DIR__ . '/views/footer.php'; ?>