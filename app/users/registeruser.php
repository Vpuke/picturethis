<?php

require __DIR__ . '/../autoload.php';

if (isset($_POST['fullname'], $_POST['username'], $_POST['email'], $_POST['password'])) {

    if ($_POST['password'] !== $_POST['password-repeat']) {
        $_SESSION['message'] = "Your passwords do not match, try again";
        redirect('/registeruser.php');
    }

    $fullname = trim(filter_var($_POST['fullname'], FILTER_SANITIZE_STRING));
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $email  = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = trim(password_hash($_POST['password'], PASSWORD_DEFAULT));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "The email is not a valid emailaddress.";
    }

    if (emailExists($email, $pdo)) {
        $_SESSION['message'] = "The email is already in use, please try again";
        redirect('/registeruser.php');
    }

    if (userExists($username, $pdo)) {
        $_SESSION['message'] = "That username is already in use, please try again";
        redirect('/registeruser.php');
    }

    $profileimage = 'placeholder.png';
    $biography = "Go to Settings or Edit Profile to update your biography";

    $statement = $pdo->prepare('INSERT INTO users (fullname, username, email, password, profileimage, biography) 
                                VALUES (:fullname, :username, :email, :password, :profileimage, :biography)');

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':profileimage', $profileimage, PDO::PARAM_STR);
    $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
    $statement->execute();

    redirect('/index.php');
    $_SESSION['message'] = "You created an account! Please login.";
}

redirect('/');
