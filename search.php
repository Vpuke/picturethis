<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>