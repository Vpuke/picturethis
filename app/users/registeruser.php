<?php

require __DIR__ . '/../autoload.php';

if (isset($_POST['fullname'], $_POST['username'], $_POST['email'], $_POST['password'])) {

    $fullname = trim(filter_var($_POST['fullname'], FILTER_SANITIZE_STRING));
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $email  = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = trim(password_hash($_POST['password'], PASSWORD_DEFAULT));


    $statement = $pdo->prepare('INSERT INTO users (fullname, username, email, password) VALUES (:fullname, :username, :email, :password)');

    $statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();
};

redirect('/');
