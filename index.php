<?php require __DIR__ . '/views/header.php'; ?>

<?php if (isLoggedIn()) : ?>

    <?php $user = getUserById($_SESSION['user']['id'], $pdo); ?>
    <?php $allPosts = getAllPosts($pdo); ?>


    <section class="userFeed">
        <?php foreach ($allPosts as $post) : ?>
            <div class="feedPosts">
                <div class="info-top-image">
                    <img class="profile-image-src profile-image-src-small" src="<?= 'app/users/images/' . $user['profileimage'] ?>" alt="Profile-image">
                    <p class="username"><?= $post['username'] ?></p>
                </div>
                <img class="largePosts" src="<?= 'app/posts/uploads/' . $post['postImage'] ?>" alt="">
                <?php $likes = countLikes($post['id'], $pdo) ?>
                <?php $isLikedByUser = isLikedByUser($post['id'], $_SESSION['user']['id'], $pdo); ?>
                <div class="info-bottom-image">
                    <div class="likes-position">
                        <form data-id="<?= $post['id'] ?>" class="likeForm" action="app/posts/likes.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="postId" value="<?= $post['id'] ?>">
                            <button data-id="<?= $post['id'] ?>" class=" button-likes like <?= $isLikedByUser ? 'hidden' : '' ?>" type=" submit" name="postId" value="<?= $post['id'] ?>"><i class="fas fa-heart"></i></button>
                            <button data-id="<?= $post['id'] ?>" class=" button-liked like <?= $isLikedByUser ? '' : 'hidden' ?>" type=" submit" name="postId" value="<?= $post['id'] ?>"><i class="fas fa-heart"></i></button>
                        </form>
                        <p class="likeCount<?= $post['id'] ?>"><?php echo $likes ?></p>
                    </div>
                    <p class="username"><?= $post['username'] ?></p>
                    <p><?= $post['postContent'] ?></p>
                    <p><?php $date = $post['createdAt'];
                        $currentDate = explode("-", $date);
                        echo $currentDate[0] . '-' . $currentDate[1] . '-' . $currentDate[2] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <?php require __DIR__ . '/views/footer.php'; ?>
<?php else : ?>

    <article class="loginPage">
        <div class="loginPageText">
            <h1>A new way to access your friends photos.</h1>
        </div>
        <div class="loginPageText">
            <h2>Login or sign up!</h2>
        </div>

        <form class="index-form" action="app/users/login.php" method="post">

            <div class="form-information">
                <label class="general-label" for="email">Username</label>
                <input class="input-field-information" type="username" name="username" id="username" placeholder="Enter Username" required>
            </div>

            <div class="form-information">
                <label class="general-label" for="password">Password</label>
                <input class="input-field-information" type="password" name="password" id="password" placeholder="Enter Password" required>
            </div>

            <button type="submit" class="submit-button" name="button">Login</button>

            <?php if (isset($_SESSION['message'])) : ?>
                <p><?php echo $_SESSION['message'];
                    unset($_SESSION['message']); ?></p>
            <?php endif; ?>
        </form>
        <p class="account">Do not have an account? Sign up <a href="/registeruser.php">here</a></p>

    </article>




<?php endif; ?>