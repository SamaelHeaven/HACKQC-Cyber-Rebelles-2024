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

$eventDetailsTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/src/php/templates/event-details-template.php");
$eventDetailsTemplate->setVariable("event", $event);

?>
<?= $headTemplate->render() ?>
<?= $eventDetailsTemplate->render() ?>
<?= $legsTemplate->render() ?>