<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isLoggedIn() && isset($_FILES['profileimage'])) {
    $profileImage = $_FILES['profileimage'];
    $username = $_SESSION['user']['username'];
    $id = (int) $_SESSION['user']['id'];
    $pathToFile = __DIR__.'/images/';
    $fileType = pathinfo($_FILES['profileimage']['name'], PATHINFO_EXTENSION);

    $newProfileImage = $username.'-'.date('ymd').'.'.$fileType;

    if ($profileImage['size'] >= 3000000) {
        $_SESSION['message'] = 'The image you chose is too big';
        redirect('/settings.php');
    }

    if ($profileImage['type'] !== 'image/jpeg' && $profileImage['type'] !== 'image/png') {
        $_SESSION['message'] = 'The image file type is not allowed.';
    } else {
        filter_var($profileImage['name'], FILTER_SANITIZE_STRING);

        $statement = $pdo->prepare('UPDATE users SET profileimage = :profileimage WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':profileimage', $newProfileImage, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        move_uploaded_file($profileImage['tmp_name'], $pathToFile.$newProfileImage);
    }
    $_SESSION['message'] = 'Your profile image was successfully changed';
    $_SESSION['user']['profileimage'] = $newProfileImage;
    redirect('/settings.php');
}
redirect('/');
