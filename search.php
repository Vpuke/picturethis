<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<?php if (isLoggedIn()) : ?>

    <section class="search-page">
        <form class="search-form" action="search.php" method="get" enctype="multipart/form-data">
            <div class="form-information">
                <label class="general-label" for="search">
                    <h2>Search:</h2>
                </label>
                <input class="input-field-information" type="text" name="search" placeholder="Search for users..." />
            </div>
        </form>
    </section>

    <section class="search-result">
        <?php if (isset($_GET['search'])) : ?>
            <?php $results = getSearchResult($_GET['search'], $pdo); ?>
            <ul class="search-result">
                <?php foreach ($results as $result) : ?>
                    <li>
                        <img loading="lazy" class="profile-image-src profile-image-src-small" src="<?= 'app/users/images/' . $result['profileimage'] ?>" alt="Profile-image">
                        <a href="<?php echo 'profile.php?id=' . $result['id']; ?>">
                            <p class="username-top"><?= $result['username'] ?></p>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>

<?php endif; ?>

<?php require __DIR__ . '/views/footer.php'; ?>