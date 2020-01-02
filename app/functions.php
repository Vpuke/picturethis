<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
};

/**
 * 
 * Checks if email exists and finds correct user
 * 
 * @param string $email
 * 
 * @param string $pdo
 * 
 * @return array
 * 
 */

function emailExists(string $email, object $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email;');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        return true;
    }
    return false;
}

/**
 * 
 * Checks if username exists and finds correct user
 * 
 * @param string $username
 * 
 * @param string $pdo
 * 
 * @return array
 * 
 */

function userExists(string $username, object $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username;');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        return true;
    }
    return false;
}


/**
 * Checks if user is logged in
 *
 * @param int $id
 *
 * @return bool
 */
function isLoggedIn(): bool
{
    return isset($_SESSION['user']);
}




function getUserById(int $id, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        return $user;
    }
    return $user = [];
}


/**
 * 
 *  Returns all posts from a user
 * 
 * @param int $postId
 * @param PDO $pdo
 * @return array
 * 
 */

function getPostsByUser(int $id, object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE userId = :userId');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':userId', $id, PDO::PARAM_INT);
    $statement->execute();

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
}
