<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_FILES['profileimage'])) {

    $profileImage = $_FILES['profileimage'];
    $username = $_SESSION['user']['username'];
    $id = (int) $_SESSION['user']['id'];
    $pathToFile = __DIR__ . '/images';
    $fileType = pathinfo($_FILES['profileimage']['name'], PATHINFO_EXTENSION);

    //Created new variable for new profile image username with date of upload and current filetype of image.

    $newProfileImage = $username . '-' . date('ymd') . '.' . $fileType;

    // Makes sure that the size of the image is smaller than 3mb

    if ($profileImage['size'] >= 3000000) {
        $_SESSION['message'] = "The image you chose is too big";
        redirect('/settings.php');
    } else {
        filter_var($profileImage['name'], FILTER_SANITIZE_STRING);

        // Query for updating database with new profile image.
        $statement = $pdo->prepare('UPDATE users SET profileimage = :profileimage WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':profileimage', $newProfileImage, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        // Moves the image to correct folder and     
        move_uploaded_file($newProfileImage, $pathToFile);
        $_SESSION['message'] = "Your profile image was successfully changed";
        redirect('/settings.php');
    }
    redirect('/');
}
