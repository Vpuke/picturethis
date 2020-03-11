<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['delete-button'])) {
    $id = (int) $_SESSION['user']['id'];
    $profileImage = $_SESSION['user']['profileimage'];

    if ($profileImage !== 'placeholder.png') {
        unlink(__DIR__ . '/images/' . $profileImage);
    }

    $posts = getPostsByUser($id, $pdo);

    foreach ($posts as $post) {
        unlink(__DIR__ . '/../posts/uploads/' . $post['postImage']);
    }

    $statement = $pdo->prepare('DELETE FROM users WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $statement = $pdo->prepare('DELETE FROM posts where userId = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $statement = $pdo->prepare('DELETE FROM likes WHERE userId = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
}

session_destroy();
redirect('/');
