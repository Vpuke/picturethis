<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

header('Content-Type: application/json');

if (isLoggedIn() && isset($_POST['profile'])) {
    $loggedInUserId = (int) $_SESSION['user']['id'];
    $profileId = (int) filter_var($_POST['profile'], FILTER_SANITIZE_NUMBER_INT);

    if (!isFollowed($loggedInUserId, $profileId, $pdo)) {
        $statement = $pdo->prepare('INSERT INTO followers (profileId, followerId) VALUES (:profileId, :followerId)');

        if (!$statement) {
            die(var_dump($pdo->errorinfo()));
        }

        $statement->bindParam(':profileId', $profileId, PDO::PARAM_INT);
        $statement->bindParam(':followerId', $loggedInUserId, PDO::PARAM_INT);
        $statement->execute();
    } else {
        $statement = $pdo->prepare('DELETE FROM followers WHERE profileId = :profileId AND followerId = :followerId');

        if (!$statement) {
            die(var_dump($pdo->errorinfo()));
        }

        $statement->bindParam(':profileId', $profileId, PDO::PARAM_INT);
        $statement->bindParam(':followerId', $loggedInUserId, PDO::PARAM_INT);
        $statement->execute();
    }

    $isFollowed = isFollowed($loggedInUserId, $profileId, $pdo);

    $json = ([
        'isFollowed' => $isFollowed
    ]);

    echo json_encode($json);
}
