<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>


<?php $user = getUserById($_SESSION['user']['id'], $pdo); ?>
<?php $id = (int) $_SESSION['user']['id']; ?>
<?php $posts = getPostsByUser($id, $pdo); ?>

<!-- Profile information -->

<section class="profile-page">
    <div class="profile-info">
        <div class="profile-image">
            <?php if (isLoggedIn()) : ?>
                <img class="profile-image-src" src="<?= 'app/users/images/' . $user['profileimage'] ?>" alt="Profile-image">
            <?php endif; ?>
        </div>

        <p> <?php echo $user['username'] ?></p>

        <div class="biography-profile-page">
            <?php if (isLoggedIn()) : ?>
                <p><?php echo $user['biography']; ?></p>
            <?php endif; ?>
        </div>

    </div>
    <a href="settings.php">Edit Profile</a>

    <!-- POSTS -->

    <?php if (isLoggedIn()) : ?>
        <div class="profileWrapper">
            <?php foreach ($posts as $post) : ?>

                <!-- <div class="smallPosts"> -->
                <img data-id="<?= $post['id'] ?>" class="profilePostSrc" src="<?= 'app/posts/uploads/' . $post['postImage'] ?>" alt="">
                <!-- </div> -->
                <div data-id="<?= $post['id'] ?>" class="postContent hidden">
                    <p><?php echo $post['createdAt']; ?></p>
                    <p><?php echo $post['postContent']; ?></p>
                </div>

                <!-- EDIT POST -->
                <div data-id="<?= $post['id'] ?>" class="updatePostContent hidden">
                    <form action="app/posts/update.php" method="post" enctype="multipart/form-data">
                        <label for="editPost">Edit post description</label>
                        <textarea name="editPost" cols="30" rows="10" placeholder=""></textarea>
                        <button class="button-primary" type="submit" name="postId" value="<?= $post['id'] ?>">Update Post</button>
                        <button class="button-primary" type="submit" name="postId" value="<?= $post['id'] ?>">Delete Post</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</section>




<?php require __DIR__ . '/views/footer.php'; ?>