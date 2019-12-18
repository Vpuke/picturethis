<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// update biography

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

    $userBiography = $user['biography'];

    // MAKING SURE THAT IF BIO IS EMPTY IT DOESNT UPDATE DATABASE WITH NULL. SINCE YOU CAN CHANGE NAME AND USERNAME IN SAME FORM

    if ($_POST['biography'] == "") {
        $biography = $_SESSION['user']['biography'];
    } else {

        $statement = $pdo->prepare('UPDATE users SET biography = :biography WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        $_SESSION['message'] = "Your personal settings has been updated";
    }
    // MAKING SURE THAT IF NAME IS EMPTY IT DOESNT UPDATE DATABASE WITH NULL, SINCE YOU CAN CHANGE BIO AND USERNAME IN SAME FORM.
    if ($_POST['edit-name'] == "") {
        $name = $_SESSION['user']['name'];
    } else {

        $statement = $pdo->prepare('UPDATE users SET fullname = :fullname WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':fullname', $name, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $_SESSION['message'] = "Your personal settings has been updated";
    }

    // Making sure that if username is empty it doesnt update database with null, since you can change bio and name in the same form.

    if ($_POST['edit-username'] == "") {
        $username = $_SESSION['user']['username'];
    } else {

        $statement = $pdo->prepare('UPDATE users SET username = :username WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $_SESSION['message'] = " Your personal settings has been updated";
    }

    redirect('/settings.php');
}

// FIGURE OUT HOW TO INCLUDE NAME AND USERNAME IN THIS SESSION.
