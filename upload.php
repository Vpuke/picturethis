<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<section class="upload-page">

    <h3>Upload post</h3>

    <!-- <div class="upload-image">
        <?php if (isLoggedIn()) : ?>
            <img src="<?= 'app/users/images/' . $user['profileimage'] ?>" alt="Profile-image"> 
        <?php endif; ?>
    </div> -->

    <form class="upload-form" action="app/posts/upload.php" method="post" enctype="multipart/form-data">
        <div class="form-information">
            <label for="upload-image">Choose your post image</label>
            <input class="input-field-information" type="file" accept="image/jpeg, image/png" name="post_image" required>
            <br>
            <label for="upload-description">Write post description</label>
            <textarea name="post_content" cols="30" rows="10"></textarea>
            <br>
            <button class="button-primary" type="submit" name="button">Upload Post</button>
        </div>
    </form>

</section>



<?php require __DIR__ . '/views/footer.php'; ?>