<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['current-password'], $_POST['new-password'], $_POST['repeat-password'])) {

    $currentPassword = trim($_POST['current-password']);
    $newPassword = trim($_POST['new-password']);
    $repeatPassword = trim($_POST['repeat-password']);
    $id = (int) $_SESSION['user']['id'];

    $statement = $pdo->query('SELECT password FROM users WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (password_verify($currentPassword, $user['password'])) {

        if ($newPassword == $repeatPassword) {

            $statement = $pdo->prepare('UPDATE users SET password = :password WHERE id = :id');

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':password', password_hash($newPassword, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);

            $statement->execute();

            $_SESSION['message'] = "Your Password has successfully been changed";

            $_SESSION['user']['password'] = $newPassword;
        } else {
            $_SESSION['message'] = "Your new Passwords do not match, try again!";
        }
    } else {
        $_SESSION['message'] = "Your old Password does not match, try again!";
    }
} else {
    redirect('/');
}

redirect('/../settings.php');
