<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/models/Template.php");
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/php/models/CurrentPage.php";
require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/services/DatabaseService.php");

$headTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/src/php/templates/head-template.php");
$headTemplate->setVariable("title", "FitQuest - Ajout d'événement");

$formTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/src/php/templates/add-event-form-template.php");

$legsTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/src/php/templates/legs-template.php");

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
$receivedElement = DatabaseService::query("SELECT * FROM  sport_terrain where id = '" . DatabaseService::escapeString($terrainId) . "'");
if ($receivedElement === null || sizeof($receivedElement) === 0) {
    header('Location: ' . "/public/views/home");
}

$formTemplate->setVariable('terrainId', $terrainId);

if (isset($_POST['organizer']) &&
    isset($_POST['eventName']) &&
    isset($_POST['description']) &&
    isset($_POST['startDate']) &&
    isset($_POST['endDate']) &&
    isset($_POST['startTime']) &&
    isset($_POST['endTime'])) {

    $organizer = htmlspecialchars(DatabaseService::escapeString($_POST['organizer']));
    $eventName = htmlspecialchars(DatabaseService::escapeString($_POST['eventName']));
    $description = htmlspecialchars(DatabaseService::escapeString($_POST['description']));
    $startDate = htmlspecialchars(DatabaseService::escapeString($_POST['startDate']));
    $endDate = htmlspecialchars(DatabaseService::escapeString($_POST['endDate']));
    $startTime = htmlspecialchars(DatabaseService::escapeString($_POST['startTime']));
    $endTime = htmlspecialchars(DatabaseService::escapeString($_POST['endTime']));

    $formTemplate->setVariable('organizer', $organizer);
    $formTemplate->setVariable('eventName', $eventName);
    $formTemplate->setVariable('description', $description);
    $formTemplate->setVariable('startDate', $startDate);
    $formTemplate->setVariable('endDate', $endDate);
    $formTemplate->setVariable('startTime', $startTime);
    $formTemplate->setVariable('endTime', $endTime);


} else {
    $formTemplate->setVariable('detectError', false);
}

?>

<?= $headTemplate->render() ?>

<form class="mt-4 mb-3" action="index.php" method="post">
    <?= $formTemplate->render() ?>
</form>

<?= $legsTemplate->render() ?>