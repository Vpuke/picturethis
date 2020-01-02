<?php
// Always start by loading the default application setup.
require __DIR__ . '/../app/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $config['title']; ?></title>

    <script src="https://kit.fontawesome.com/83f8941984.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <?php require __DIR__ . '/navigation.php'; ?>