<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/services/DatabaseService.php");

$id = $_GET['id'] ?? null;

if ($id == null) {
    header('location: /public/views/home/');
}

$event = DatabaseService::query("SELECT * FROM event WHERE id = '$id'")[0];

if ($event == null) {
    header('location: /public/views/home/');
}

$sportTerrain = DatabaseService::query("SELECT * FROM sport_terrain WHERE id = '" . $event['sport_terrain_id'] . "'")[0];

if ($sportTerrain == null) {
    header('location: /public/views/home/');
}

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/models/Template.php");
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/php/models/CurrentPage.php";

$headTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/head-template.php");
$headTemplate->setVariable("title", "FitQuest - Accueil");

$legsTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/legs-template.php");

?>
<?= $headTemplate->render() ?>
    <div class="wrapper-md my-4 border border-2 bg-light rounded p-3">
        <h2 class="text-center">
            <?= $event['eventname'] ?>
        </h2>
        <hr>
        <div class="pb-2">
            <span class="fw-bold">Organisateur:</span> <?= $event['organizer'] ?>
        </div>
        <div class="pb-2">
            <span class="fw-bold">Date:</span> Du <?= $event['datestart'] ?> : <?= substr($event['timestart'], 0, 5) ?>
            <span class="fw-bold">à</span> <?= $event['dateend'] ?> : <?= substr($event['timeend'], 0, 5) ?>
        </div>
        <p>
            <span class="fw-bold">Description:</span> <?= $event['description'] ?>
        </p>
        <table class="table table-responsive table-striped">
            <tbody>
            <tr>
                <th scope="row">Type de terrain</th>
                <td><?= $sportTerrain["json_featuretype"] . " - " . $sportTerrain["type"] ?></td>
            </tr>
            <tr>
                <th scope="row">Revêtement du sol</th>
                <td><?= $sportTerrain["revetement_sol"] ?></td>
            </tr>
            <tr>
                <th scope="row">Municipalité</th>
                <td><?= $sportTerrain["municipalite"] ?></td>
            </tr>
            <tr>
                <th scope="row">Longitude</th>
                <td><?= $sportTerrain["longitude"] ?></td>
            </tr>
            <tr>
                <th scope="row">Latitude</th>
                <td><?= $sportTerrain["latitude"] ?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?= $legsTemplate->render() ?>