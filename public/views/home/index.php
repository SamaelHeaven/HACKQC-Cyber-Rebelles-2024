<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/models/Template.php");
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/php/models/CurrentPage.php";

$headTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/head-template.php");
$headTemplate->setVariable("title", "FitQuest - Home");
$headTemplate->setVariable("mainClasses", "d-flex flex-column justify-content-between min-vh-100");
$headTemplate->setVariable("currentPage", CurrentPage::Home);

$legsTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/legs-template.php");

$mapTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/map-template.php");
$mapTemplate->setVariable("latitude", 45.751258);
$mapTemplate->setVariable("longitude", -73.442155);

?>
<?= $headTemplate->render() ?>

<?= $mapTemplate->render() ?>

<?= $legsTemplate->render() ?>