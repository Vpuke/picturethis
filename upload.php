<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<?php $allPosts = getAllPosts($pdo); ?>

<section class="upload-page">

    <h2>Upload post</h2>

    <form class="upload-form" action="app/posts/upload.php" method="post" enctype="multipart/form-data">
        <div class="form-information">
            <label class="general-label" for="upload-image">Choose your post image</label>
            <input class="input-field-information " type="file" accept="image/jpeg, image/png" name="post_image" required>
            <br>
            <label class="general-label" for="upload-description">Write post description</label>
            <textarea name="post_content" cols="30" rows="10"></textarea>
            <br>
            <button class="submit-button" type="submit" name="button">Upload Post</button>
        </div>
        <p class="message"><?php require __DIR__ . '/views/usermessage.php'; ?></p>
    </form>

</section>



<?php require __DIR__ . '/views/footer.php'; ?>