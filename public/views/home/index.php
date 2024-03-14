<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/models/Template.php");

$headTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/head-template.php");
$headTemplate->setVariable("title", "FitQuest - Home");

$legsTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/legs-template.php");

$mapTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/map-template.php");

?>
<?= $headTemplate->render() ?>

<?= $mapTemplate->render() ?>

<?= $legsTemplate->render() ?>