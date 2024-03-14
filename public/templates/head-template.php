<?php

/*
 * string $title: The title of the page
 */

$title ??= "";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/stylesheets/styles.css">
    <script type="module" src="/public/javascript/app.js"></script>
    <title><?= $title ?></title>
</head>
<body>
<main>