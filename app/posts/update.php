<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['editPost'], $_POST['postId'])) {

    $editPost = $_POST['editPost'];
    $postId = $_POST['postId'];
    $id = (int) $_SESSION['user']['id'];


    $statement = $pdo->prepare('UPDATE posts SET postContent = :postContent WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':postContent', $editPost, PDO::PARAM_STR);

    $statement->execute();

    $_SESSION['message'] = "Your post description was successfully changed";
}
redirect('/');
