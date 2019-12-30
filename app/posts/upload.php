<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_FILES['post_image'], $_POST['post_content'])) {

    $postDescription = trim(filter_var($_POST['post_content'], FILTER_SANITIZE_STRING));
    $postImage = $_FILES['post_image'];
    $username = $_SESSION['user']['username'];
    $id = (int) $_SESSION['user']['id'];
    $pathToFile = __DIR__ . '/uploads/';
    $fileType = pathinfo($_FILES['post_image']['name'], PATHINFO_EXTENSION);


    $newPostImage = $username . '-' . date('ymd') . '.' . $fileType;
}
