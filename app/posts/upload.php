<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isLoggedIn() && isset($_FILES['post-image'], $_POST['post-content'])) {
    $postDescription = trim(filter_var($_POST['post-content'], FILTER_SANITIZE_STRING));
    $postImage = $_FILES['post-image'];
    $username = $_SESSION['user']['username'];
    $id = (int) $_SESSION['user']['id'];
    $pathToFile = __DIR__.'/uploads/';
    $fileType = pathinfo($_FILES['post-image']['name'], PATHINFO_EXTENSION);
    $dateAndTime = date('d-M-Y-H:i:s');

    $newPostImage = $username.'-'.$dateAndTime.'.'.$fileType;

    if ($postImage['size'] >= 3000000) {
        $_SESSION['message'] = 'The image you chose is too big';
        redirect('/upload.php');
    }
    if ($postImage['type'] !== 'image/jpeg' && $postImage['type'] !== 'image/png') {
        $_SESSION['message'] = 'The image file type is not allowed.';
    } else {
        filter_var($postImage['name'], FILTER_SANITIZE_STRING);

        $statement = $pdo->prepare('INSERT INTO posts(postImage, postContent, userId, createdAt) VALUES(:postImage, :postContent, :userId, :createdAt)');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':createdAt', $dateAndTime, PDO::PARAM_STR);
        $statement->bindParam(':postImage', $newPostImage, PDO::PARAM_STR);
        $statement->bindParam('postContent', $postDescription, PDO::PARAM_STR);
        $statement->bindParam(':userId', $id, PDO::PARAM_INT);
        $statement->execute();

        move_uploaded_file($postImage['tmp_name'], $pathToFile.$newPostImage);
    }
    $_SESSION['message'] = 'Your post was successfully uploaded';
    $_SESSION['posts']['post-image'] = $newPostImage;
    redirect('/profile.php');
}
redirect('/');
