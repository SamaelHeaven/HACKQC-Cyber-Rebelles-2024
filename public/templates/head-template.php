<?php

/*
 * string $title: The title of the page
 * CurrentPage $currentPage: The current page of the site
 */

require_once $_SERVER["DOCUMENT_ROOT"] . "/src/php/models/CurrentPage.php";

$title ??= "";
$currentPage ??= CurrentPage::Home;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <link rel="stylesheet" href="/public/stylesheets/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    <script src="https://kit.fontawesome.com/74353d55c6.js" crossorigin="anonymous"></script>
    <script type="module" src="/public/javascript/app.js"></script>
    <title><?= $title ?></title>
</head>
<body>
<main class="d-flex flex-column justify-content-between min-vh-100">
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <header class="w-100">
                <div class="d-flex justify-content-between">
                    <a class="navbar-brand nav-name d-flex gap-2 align-items-center" href="/public/views/home/">
                        <img src="/public/images/fitQuestLogo.png" alt="Logo"
                             class="d-inline-block align-text-top nav-logo">
                        FitQuest
                    </a>
                    <div class="navbar-nav d-flex flex-row align-items-center gap-4 ">
                        <a class="nav-link<?= $currentPage == CurrentPage::Home ? " active" : "" ?>" href="/public/views/home/">Accueil</a>
                        <a class="nav-link<?= $currentPage == CurrentPage::About ? " active" : "" ?>" href="/public/views/about/">À propos</a>
                    </div>
                </div>
            </header>
        </div>
    </nav>