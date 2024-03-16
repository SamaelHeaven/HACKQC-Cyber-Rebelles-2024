<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/services/DatabaseService.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/models/Template.php");
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/php/models/CurrentPage.php";

$headTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/src/php/templates/head-template.php");
$headTemplate->setVariable("title", "FitQuest - Événement");

$legsTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/src/php/templates/legs-template.php");


if (isset($_POST['deleteEvent'])) {
    $eventToDeleteId = $_POST['deleteEvent'];

    $result = DatabaseService::query("DELETE FROM event WHERE id = '" . DatabaseService::escapeString($eventToDeleteId) . "'");

    echo $headTemplate->render();
    ?>

    <div class="wrapper-sm">
        <div class="alert alert-success my-4 text-center" role="alert">
            L'événement a bien été supprimé.
        </div>
    </div>

    <?php
    echo $legsTemplate->render();

    exit;
}

$id = $_GET['id'] ?? null;

if ($id === null) {
    header('location: /public/views/home/');
}

$event = DatabaseService::query("SELECT * FROM event WHERE id = '$id'");

if ($event === null || sizeof($event) === 0) {
    header('location: /public/views/home/');
}

$event = $event[0];

$sportTerrain = DatabaseService::query("SELECT * FROM sport_terrain WHERE id = '" . $event['sport_terrain_id'] . "'")[0];

if ($sportTerrain === null) {
    header('location: /public/views/home/');
}

?>
<?= $headTemplate->render() ?>
    <div class="mx-2">
        <div class="wrapper-md my-4 border border-2 bg-light rounded p-3">
            <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                <button class="btn btn-secondary" onclick="history.back()">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                <h2>
                    <?= $event['event_name'] ?>
                </h2>
                <form action="index.php" method="post">
                    <button type="submit" name="deleteEvent" value="<?= $event['id'] ?>" class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
            <hr>
            <div class="pb-2">
                <span class="fw-bold">Organisateur:</span> <?= $event['organizer'] ?>
            </div>
            <div class="pb-2">
                <span class="fw-bold">Date:</span> Du <?= $event['start_date'] ?>
                : <?= substr($event['start_time'], 0, 5) ?>
                à <?= $event['start_date'] ===  $event['end_date'] ? "" : $event['end_date'] . " : " ?><?= substr($event['end_time'], 0, 5) ?>
            </div>
            <p>
                <span class="fw-bold">Description:</span> <?= $event['description'] ?>
            </p>
            <table class="table table-responsive table-striped">
                <tbody>
                <tr>
                    <th scope="row">Type de terrain</th>
                    <td><?= $sportTerrain["terrain"] . " - " . $sportTerrain["type"] ?></td>
                </tr>
                <tr>
                    <th scope="row">Revêtement du sol</th>
                    <td><?= $sportTerrain["flooring"] ?></td>
                </tr>
                <tr>
                    <th scope="row">Municipalité</th>
                    <td><?= $sportTerrain["city"] ?></td>
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
    </div>
<?= $legsTemplate->render() ?>