<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     * @param string $path
     * @return void
     */

    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
};


/**
 * Checks if email exists and finds correct user
 * @param string $email
 * @param string $pdo
 * @return array
 */

function emailExists(string $email, object $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');

    $statement->bindParam(':email', $email, PDO::PARAM_STR);

    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return true;
    }
    return false;
}


/**
 * Checks if username exists and finds correct user
 * @param string $username
 * @param string $pdo
 * @return array
 */

function userExists(string $username, object $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');

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
 * @param int $id
 * @return bool
 */

function isLoggedIn(): bool
{
    return isset($_SESSION['user']);
}


/**
 *  Gets user by id
 * @param integer $id
 * @param PDO $pdo
 * @return array
 */

function getUserById(int $id, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':id' => $id
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return $user;
    }
}


/**
 *  Returns all posts from a user
 * @param int $posts
 * @param PDO $pdo
 * @return array
 */

function getPostsByUser(int $id, object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE userId = :userId ORDER BY createdAt DESC');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':userId', $id, PDO::PARAM_INT);

    $statement->execute();

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
}


/**
 *  Returns all posts from all users
 * @param PDO $pdo
 * @return array
 */

function getAllPosts(object $pdo): array
{
    $statement = $pdo->prepare('SELECT posts.id, posts.postImage, posts.postContent, posts.createdAt,
                                        users.id as userId, users.username, users.profileimage FROM posts JOIN users ON posts.userId = users.id
                                        ORDER BY createdAt DESC');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute();

    $allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $allPosts;
}


/**
 * Count likes function
 * @param int $postid
 * @param PDO $pdo
 * @return array
 */

function countLikes(int $postId, object $pdo): string
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM likes WHERE postId = :postId');

    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);

    $statement->execute();

    $likes = $statement->fetch(PDO::FETCH_ASSOC);

    return $likes["COUNT(*)"];
}


/**
 *  Checks if post is liked by user
 * @param int $postid
 * @param int $userid
 * @param PDO $pdo
 * @return bool
 */

function isLikedByUser(int $postId, int $userId, object $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM likes WHERE postId = :postId AND userId = :userId');

    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);

    $statement->execute();

    $isLikedByUser = $statement->fetch(PDO::FETCH_ASSOC);

    return $isLikedByUser ? true : false;
}


/**
 * Checks if user is owner of profile
 *
 * @param array $user
 * @return boolean
 */
function isUser($user): bool
{
    if ($_SESSION['user']['id'] === $user['id']) {
        return true;
    } else {
        return false;
    }
}


/**
 * Checks if user is followed by logged in user
 *
 * @param int $loggedInUserId
 * @param int $profileId
 * @param PDO $pdo
 * @return boolean
 */
function isFollowed(int $loggedInUserId, int $profileId, PDO $pdo): bool
{
    {
        $query = 'SELECT * FROM followers WHERE profileId = :profileId AND followerId = :followerId';

        $statement = $pdo->prepare($query);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':profileId' => $profileId,
            ':followerId' => $loggedInUserId
        ]);

        $isFollowed = $statement->fetch(PDO::FETCH_ASSOC);

        if ($isFollowed) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Get all posts from database by followed users
 *
 * @param PDO $pdo
 * @return array
 */
function getFollowedUserPosts(PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT posts.id, posts.postImage, posts.postContent, posts.createdAt, posts.userId, followers.profileId, users.id, users.username, users.profileimage FROM posts JOIN users ON users.id = posts.userId JOIN followers ON posts.userId = followers.profileId ORDER BY posts.createdAt DESC');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute();

    $followedUserPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $followedUserPosts;
}

/**
 * Returns users in database from given search query
 *
 * @param string $search
 * @param PDO $pdo
 * @return array
 */
function getSearchResult($search, $pdo): array
{
    $search = trim(filter_var($_GET['search'], FILTER_SANITIZE_STRING));
    $search = '%' . $search . '%';

    $statement = $pdo->prepare('SELECT id, username, profileImage FROM users WHERE username LIKE :search');

    if (!$statement) {
        die(var_dump($pdo->errorinfo()));
    }

    $statement->bindParam(':search', $search, PDO::PARAM_STR);
    $statement->execute();

    $searchResult = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $searchResult;
}
