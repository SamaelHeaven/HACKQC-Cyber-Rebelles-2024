<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/models/Template.php");
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/php/models/CurrentPage.php";

$headTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/src/php/templates/head-template.php");
$headTemplate->setVariable("title", "FitQuest - Accueil");
$headTemplate->setVariable("currentPage", CurrentPage::Home);

$legsTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/src/php/templates/legs-template.php");
$legsTemplate->setVariable("insideMain", false);

$mapTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/src/php/templates/map-template.php");

?>
<?= $headTemplate->render() ?>

<?= $mapTemplate->render() ?>

<?= $legsTemplate->render() ?>