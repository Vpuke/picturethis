<?php

require __DIR__ . '/../autoload.php';


if (isset($_POST['name'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_repeat'])) {

    if ($_POST['password'] !== $_POST['password_repeat']) {
        $_SESSION['message'] = "Your passwords does not match, please try again";
        redirect('/registeruser.php');
    } else {

        $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
        $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
        $email  = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $password = trim(password_hash($_POST['password'], PASSWORD_DEFAULT));

        $statement = $pdo->prepare('SELECT email, username FROM users WHERE email = :email AND username = :username');

        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);

        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user['email'] == $email && $user['username'] == $username) {
            $_SESSION['message'] = 'You already have an account. Please sign in';
            redirect('login.php');
        } else {

            $statement = $pdo->prepare('INSERT INTO users (name, email, username, password) VALUES (:name, :email, :username, :password)');

            $statement->bindParam(':name', $name, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->bindParam(':password', $password, PDO::PARAM_STR);

            $statement->execute();

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            $_SESSION['message'] = 'You have successfully created an account! Please log in.';
            redirect('/login.php');
        }

        redirect('/registeruser.php');
    }
}
