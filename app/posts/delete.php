<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['postId'])) {
    $postId = $_POST['postId'];
    $userId = (int) $_SESSION['user']['id'];
    $userFolder = $userId;

    $userPosts = getPostsByUser($userId, $pdo);

    foreach ($userPosts as $userPost) {
        if ($postId == $userPost['id']) {
            $image = $userPost['postImage'];

            $statement = $pdo->prepare('DELETE FROM posts WHERE id = :id and postImage = :postImage');

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':id', $postId, PDO::PARAM_INT);
            $statement->bindParam(':postImage', $image, PDO::PARAM_STR);
            $statement->execute();

            unlink(__DIR__ . '/uploads' . $userFolder . '/' . $image . '');

            $_SESSION['message'] = "Your post was successfully deleted";
        }
    }
    redirect('/profile.php');
}

redirect('/');
