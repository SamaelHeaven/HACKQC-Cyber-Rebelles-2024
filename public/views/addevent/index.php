<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/models/Template.php");
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/php/models/CurrentPage.php";

$headTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/head-template.php");
$headTemplate->setVariable("title", "FitQuest - AddEvent");
$headTemplate->setVariable("currentPage", CurrentPage::None);

$formTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/add-event-form-template.php");

$legsTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/legs-template.php");

$organizer = "";
$eventName = "";
$description = "";
$dateStart = "";
$dateEnd = "";
$timeStart = "";
$timeEnd = "";
$errorMessage = "";

if (isset($_POST['organizer']) &&
    isset($_POST['eventName']) &&
    isset($_POST['description']) &&
    isset($_POST['dateStart']) &&
    isset($_POST['dateEnd']) &&
    isset($_POST['timeStart']) &&
    isset($_POST['timeEnd'])){

    $organizer = $_POST['organizer'];
    $eventName = $_POST['eventName'];
    $description = $_POST['description'];
    $dateStart = $_POST['dateStart'];
    $dateEnd = $_POST['dateEnd'];
    $timeStart = $_POST['timeStart'];
    $timeEnd = $_POST['timeEnd'];

    if (!($organizer == "" ||
    $eventName == "" ||
    $description == "" ||
    $dateStart == "" ||
    $dateEnd == "" ||
    $timeStart == "" ||
    $timeEnd == "")) {

        if ( $timeStart < $timeEnd && $dateStart <= $dateEnd){
            header('Location: ' . "/public/views/home");
        } else {
            $errorMessage = "la date ou l'heure de fin ne peut pas etre inferieure a celle du debut ";
        }

    } else {
        $errorMessage = "L'un des champs n'a pas été rempli";
    }
}

?>

<?= $headTemplate->render() ?>

<form class="m-4" action="" method="post">
    <?= $formTemplate->render() ?>
</form>

<?= $legsTemplate->render() ?>
