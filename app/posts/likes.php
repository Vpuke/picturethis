<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['postId'])) {

    $postId = $_POST['postId'];
    $userId = (int) $_SESSION['user']['id'];

    $statement = $pdo->prepare('SELECT * FROM likes WHERE userId = :userId AND postId = :postId');

    if (!$statement) {
        die(var_dump($pdo->errorinfo()));
    }

    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);

    $statement->execute();

    $isLikedByUser = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$isLikedByUser) {
        $statement = $pdo->prepare('INSERT INTO likes (userId, postId) VALUES (:userId, :postId)');

        if (!$statement) {
            die(var_dump($pdo->errorinfo()));
        }

        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->bindParam(':postId', $postId, PDO::PARAM_INT);

        $statement->execute();
    } else {

        $statement = $pdo->prepare('DELETE FROM likes WHERE userId = :userId AND postId = :postId');

        if (!$statement) {
            die(var_dump($pdo->errorinfo()));
        }

        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->bindParam(':postId', $postId, PDO::PARAM_INT);

        $statement->execute();
    }

    $likes = countLikes($postId, $pdo);
    $likes = json_encode($likes);
    header('Content-Type: application/json');
    echo $likes;
} else {

    redirect('/index.php');
}
