<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['biography'])) {

    $biography = trim(filter_var($_POST['biography'], FILTER_SANITIZE_STRING));
    $id = (int) $_SESSION['user']['id'];

    $statement = $pdo->prepare('SELECT biography FROM users WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $userBiography = $user['biography'];

    $statement = $pdo->prepare('UPDATE users SET biography = :biography WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();

    $_SESSION['message'] = "Your Biography has been updated";

    redirect('/settings.php');
}
