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

        <p class=> <?php echo $user['username'] ?></p>

        <div class="biography-profile-page">
            <?php if (isLoggedIn()) : ?>
                <p><?php echo $user['biography']; ?></p>
            <?php endif; ?>
        </div>

    </div>

    <form>
        <input type="button" class="submit-button" value="Edit Profile" onclick="window.location.href='settings.php'">
    </form>
    <p class="message"><?php require __DIR__ . '/views/usermessage.php'; ?></p>

    <!-- POSTS -->

    <?php if (isLoggedIn()) : ?>
        <div class="profile-wrapper">
            <?php foreach ($posts as $post) : ?>
                <div data-id="<?= $post['id'] ?>" class="profile-post">
                    <img data-id="<?= $post['id'] ?>" class="profile-post-src" src="<?= 'app/posts/uploads/' . $post['postImage'] ?>" alt="">
                    <div data-id="<?= $post['id'] ?>" class="post-content ">
                        <?php $likes = countLikes($post['id'], $pdo) ?>
                        <?php $isLikedByUser = isLikedByUser($post['id'], $_SESSION['user']['id'], $pdo); ?>
                        <div class="info-bottom-image">
                            <div class="likes-position">
                                <form data-id="<?= $post['id'] ?>" class="like-form" action="app/posts/likes.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="postId" value="<?= $post['id'] ?>">
                                    <button data-id="<?= $post['id'] ?>" class=" button-likes like <?= $isLikedByUser ? 'hidden' : '' ?>" type=" submit" name="postId" value="<?= $post['id'] ?>"><i class="fas fa-heart"></i></button>
                                    <button data-id="<?= $post['id'] ?>" class=" button-liked like <?= $isLikedByUser ? '' : 'hidden' ?>" type=" submit" name="postId" value="<?= $post['id'] ?>"><i class="fas fa-heart"></i></button>
                                </form>
                                <p class="likeCount<?= $post['id'] ?>"><?php echo $likes ?></p>
                            </div>
                            <p class="content-bottom"><?php echo $post['postContent']; ?></p>
                            <p class="date-bottom"><?php $date = $post['createdAt'];
                                                    $currentDate = explode("-", $date);
                                                    echo $currentDate[0] . '-' . $currentDate[1] . '-' . $currentDate[2] ?></p>
                        </div>
                        <!-- EDIT POST -->

                        <div data-id="<?= $post['id'] ?>" class="update-post-content ">
                            <form class="edit-post-form" action="app/posts/update.php" method="post" enctype="multipart/form-data">
                                <label class="general-label hidden" for="editPost">Edit post description</label>
                                <textarea class="textarea-post hidden" name="editPost" cols="30" rows="10" placeholder=""></textarea>
                                <button data-id="<?= $post['id'] ?>" class="submit-button edit-button " type="button" name="postId" value="<?= $post['id'] ?>">Edit Post</button>
                                <button class="submit-button update-post hidden" type="submit" name="postId" value="<?= $post['id'] ?>">Update Post</button>
                                <button data-id="<?= $post['id'] ?>" class="submit-button cancel-button hidden" type="button" name="postId" value="<?= $post['id'] ?>">Cancel</button>
                            </form>
                            <form class="delete-button-form" action="app/posts/delete.php" method="post" enctype="multipart/form-data">
                                <button class="submit-button button-delete " type="submit" name="postId" value="<?= $post['id'] ?>">Delete Post</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
</section>




<?php require __DIR__ . '/views/footer.php'; ?>