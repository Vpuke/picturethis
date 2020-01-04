<?php require __DIR__ . '/views/header.php'; ?>

<?php if (isLoggedIn()) : ?>

    <?php $user = getUserById($_SESSION['user']['id'], $pdo); ?>
    <?php $allPosts = getAllPosts($pdo); ?>


    <section class="userFeed">
        <?php foreach ($allPosts as $post) : ?>
            <div class="feedPosts">
                <img class="largePosts" src="<?= 'app/posts/uploads/' . $post['postImage'] ?>" alt="">
                <p><?= $post['username'] ?></p>
                <p><?= $post['createdAt'] ?></p>
                <p><?= $post['postContent'] ?></p>
                <?php $likes = countLikes($post['id'], $pdo) ?>
                <p><?php echo $likes ?></p>
                <form class="likeForm" action="app/posts/likes.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="postId" value="<?= $post['id'] ?>">
                    <button class="button-primary button-likes" type="submit" name="postId" value="<?= $post['id'] ?>"><i class="fas fa-heart"></i></button>
                    <button class="button-primary button-likes hidden" type="submit" name="postId" value="<?= $post['id'] ?>"><i class="fas fa-heart"></i></button>
                </form>
            </div>
        <?php endforeach; ?>
    </section>

    <?php require __DIR__ . '/views/footer.php'; ?>
<?php else : ?>

    <article class="loginPage">
        <div class="loginPageText">
            <h1>A new way to access your friends photos.</h1>
            <h2>Login or sign up!</h2>
        </div>

        <form class="index-form" action="app/users/login.php" method="post">

            <div class="form-information">
                <label for="email">Username:</label>
                <input class="input-field-login" type="username" name="username" id="username" placeholder="Enter Username" required>
            </div>

            <div class="form-information">
                <label for="password">Password:</label>
                <input class="input-field-login" type="password" name="password" id="password" placeholder="Enter Password" required>
            </div>

            <button type="submit" class="submit-button" name="button">Login</button>
            <p>Do not have an account? Sign up <a href="/registeruser.php">here</a></p>
            <?php if (isset($_SESSION['message'])) : ?>
                <p><?php echo $_SESSION['message'];
                    unset($_SESSION['message']); ?></p>
            <?php endif; ?>
        </form>

    </article>




<?php endif; ?>