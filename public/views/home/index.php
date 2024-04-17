<?php

require_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/src/php/models/Template.php");
require_once dirname($_SERVER["DOCUMENT_ROOT"]) . "/src/php/models/CurrentPage.php";

$headTemplate = new Template(dirname($_SERVER["DOCUMENT_ROOT"]) . "/src/php/templates/head-template.php");
$headTemplate->setVariable("title", "FitQuest - Accueil");
$headTemplate->setVariable("currentPage", CurrentPage::Home);

$legsTemplate = new Template(dirname($_SERVER["DOCUMENT_ROOT"]) . "/src/php/templates/legs-template.php");
$legsTemplate->setVariable("insideMain", false);

$mapTemplate = new Template(dirname($_SERVER["DOCUMENT_ROOT"]) . "/src/php/templates/map-template.php");

?>
<?= $headTemplate->render() ?>

    <home-component></home-component>

<?= $legsTemplate->render() ?>