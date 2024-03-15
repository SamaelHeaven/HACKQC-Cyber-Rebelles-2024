<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/models/Template.php");
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/php/models/CurrentPage.php";
require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/services/DatabaseService.php");

$headTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/head-template.php");
$headTemplate->setVariable("title", "FitQuest - Ajout d'événement");

$formTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/add-event-form-template.php");

$legsTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/legs-template.php");

$terrainId = null;
$organizer = "";
$eventName = "";
$description = "";
$startDate = "";
$endDate = "";
$startTime = "";
$endTime = "";
$errorMessage = "";

$receivedElement = null;
if (isset($_POST['terrainId'])) {
    $terrainId = $_POST['terrainId'];
} else if (isset($_GET['terrainId'])) {
    $terrainId = $_GET['terrainId'];
} else {
    header('Location: ' . "/public/views/home");
}
$receivedElement = DatabaseService::query("SELECT * FROM  sport_terrain where id = '$terrainId'");
if ($receivedElement == []) {
    header('Location: ' . "/public/views/home");
}

$formTemplate->setVariable('terrainId', $terrainId);

if (isset($_POST['organizer']) &&
    isset($_POST['event_name']) &&
    isset($_POST['description']) &&
    isset($_POST['start_date']) &&
    isset($_POST['end_date']) &&
    isset($_POST['start_time']) &&
    isset($_POST['end_time'])) {

    $organizer = DatabaseService::escapeString($_POST['organizer']);
    $eventName = DatabaseService::escapeString($_POST['event_name']);
    $description = DatabaseService::escapeString($_POST['description']);
    $startDate = DatabaseService::escapeString($_POST['start_date']);
    $endDate = DatabaseService::escapeString($_POST['end_date']);
    $startTime = DatabaseService::escapeString($_POST['start_time']);
    $endTime = DatabaseService::escapeString($_POST['end_time']);

    $formTemplate->setVariable('organizer', $organizer);
    $formTemplate->setVariable('event_name', $eventName);
    $formTemplate->setVariable('description', $description);
    $formTemplate->setVariable('start_date', $startDate);
    $formTemplate->setVariable('end_date', $endDate);
    $formTemplate->setVariable('start_time', $startTime);
    $formTemplate->setVariable('end_time', $endTime);


} else {
    $formTemplate->setVariable('detectError', false);
}

?>

<?= $headTemplate->render() ?>

<form class="mt-4 mb-3" action="index.php" method="post">
    <?= $formTemplate->render() ?>
</form>

<?= $legsTemplate->render() ?>
