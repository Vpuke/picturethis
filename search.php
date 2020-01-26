<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<?php if (isLoggedIn()) : ?>

    <section class="settings-page">
        <form class="search-form" action="search.php" method="get" enctype="multipart/form-data">
            <div class="form-information">
                <label class="general-label" for="search" placeholder="Username">Search users:</label>
                <input type="text" name="search" />
                <input type="submit" value="Submit" />
            </div>
        </form>
    </section>

    <section class="search-result">
        <?php if (isset($_GET['search'])) : ?>
            <?php $results = getSearchResult($_GET['search'], $pdo); ?>
            <?php foreach ($results as $result) : ?>
                <div class="info-top-image">
                    <img loading="lazy" class="profile-image-src profile-image-src-small" src="<?= 'app/users/images/' . $result['profileimage'] ?>" alt="Profile-image">
                    <a href="<?php echo 'profile.php?id=' . $result['id']; ?>">
                        <p class="username-top"><?= $result['username'] ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

<?php endif; ?>

<?php require __DIR__ . '/views/footer.php'; ?>