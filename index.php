<?php require __DIR__ . '/views/header.php'; ?>

<?php if (isLoggedIn()) : ?>

    <?php $user = getUserById($_SESSION['user']['id'], $pdo); ?>
    <?php $allPosts = getAllPosts($pdo); ?>

    <section class="user-feed">
        <?php foreach ($allPosts as $post) : ?>
            <div class="feed-posts">
                <div class="info-top-image">
                    <img loading="lazy" class="profile-image-src profile-image-src-small" src="<?= 'app/users/images/' . $post['profileimage'] ?>" alt="Profile-image">
                    <p class="username-top"><?= $post['username'] ?></p>
                </div>
                <img loading="lazy" class="largePosts" src="<?= 'app/posts/uploads/' . $post['postImage'] ?>" alt="">
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
                    <p class="username-bottom"><?= $post['username'] ?> </p>
                    <p class="content-bottom"><?= $post['postContent'] ?></p>
                    <p class="date-bottom"><?php $date = $post['createdAt'];
                                            $currentDate = explode("-", $date);
                                            echo $currentDate[0] . '-' . $currentDate[1] . '-' . $currentDate[2] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <?php require __DIR__ . '/views/footer.php'; ?>
<?php else : ?>

    <article class="login-page">

        <div class="logotype">
            <h1>Picture This</h1>
        </div>
        <div>
            <h1>A new way to access your friends photos.</h1>
        </div>
        <div>
            <h2>Login or sign up!</h2>
        </div>
        <form class="index-form" action="app/users/login.php" method="post">
            <div class="form-information">
                <label class="general-label" for="email">Username</label>
                <input class="input-field-information" type="username" name="username" id="username" placeholder="Enter your Username" required>
            </div>
            <div class="form-information">
                <label class="general-label" for="password">Password</label>
                <input class="input-field-information" type="password" name="password" id="password" placeholder="Enter your Password" required>
            </div>
            <button type="submit" class="submit-button" name="button">Login</button>
        </form>
        <p class="message"><?php require __DIR__ . '/views/usermessage.php'; ?><p>
                <p class="account">Do not have an account? Sign up <a href="/registeruser.php"><span>here!</span></a></p>
    </article>

<?php endif; ?>