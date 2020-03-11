<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isLoggedIn() && isset($_POST['biography'])) {
    $biography = trim(filter_var($_POST['biography'], FILTER_SANITIZE_STRING));
    $name = trim(filter_var($_POST['edit-name'], FILTER_SANITIZE_STRING));
    $username = trim(filter_var($_POST['edit-username'], FILTER_SANITIZE_STRING));
    $id = (int) $_SESSION['user']['id'];

    $statement = $pdo->prepare('SELECT biography FROM users WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($_POST['biography'] == '') {
        $biography = $_SESSION['user']['biography'];
    } else {
        $statement = $pdo->prepare('UPDATE users SET biography = :biography WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $_SESSION['message'] = 'Your personal settings has been updated';
    }

    if ($_POST['edit-name'] == '') {
        $name = $_SESSION['user']['fullname'];
    } else {
        $statement = $pdo->prepare('UPDATE users SET fullname = :fullname WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':fullname', $name, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $_SESSION['message'] = 'Your personal settings has been updated';
    }

    if ($_POST['edit-username'] == '') {
        $username = $_SESSION['user']['username'];
    } else {
        $statement = $pdo->prepare('UPDATE users SET username = :username WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $_SESSION['message'] = 'Your personal settings has been updated';
    }

    redirect('/settings.php');
}
