<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/models/Template.php");
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/php/models/CurrentPage.php";

$headTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/head-template.php");
$headTemplate->setVariable("title", "FitQuest - À propos");
$headTemplate->setVariable("currentPage", CurrentPage::About);

$aboutTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/about-template.php");

$legsTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/legs-template.php");

?>
<?= $headTemplate->render() ?>

<?= $aboutTemplate->render() ?>

<?= $legsTemplate->render() ?>
