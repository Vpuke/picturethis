<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['current-email'], $_POST['new-email'], $_POST['repeat-email'])) {
    $currentEmail = trim(filter_var($_POST['current-email'], FILTER_SANITIZE_EMAIL));
    $newEmail = trim(filter_var($_POST['new-email'], FILTER_SANITIZE_EMAIL));
    $repeatEmail = trim(filter_var($_POST['repeat-email'], FILTER_SANITIZE_EMAIL));
    $id = (int) $_SESSION['user']['id'];

    if (!filter_var($currentEmail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "The email is not a valid emailaddress.";
    }

    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "The email is not a valid emailaddress.";
    }

    if (!filter_var($repeatEmail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "The email is not a valid emailaddress.";
    }

    $statement = $pdo->query('SELECT email FROM users WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);


    if ($currentEmail == $user['email']) {
        if ($newEmail == $repeatEmail) {
            $statement = $pdo->prepare('UPDATE users SET email = :email WHERE id = :id');

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':email', $newEmail, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $_SESSION['message'] = "Your Email has successfully been changed";

            $_SESSION['user']['email'] = $newEmail;
        } else {
            $_SESSION['message'] = "Your new Emails does not match, try again!";
        }
    } else {
        $_SESSION['message'] = "Your old Email does not match, try again!";
    }
} else {
    redirect('/');
}

redirect('/../settings.php');
