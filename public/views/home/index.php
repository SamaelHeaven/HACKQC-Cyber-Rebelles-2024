<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/models/Template.php");

$headTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/head-template.php");
$headTemplate->setVariable("title", "FitQuest - Home");

$legsTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/legs-template.php");

?>
<?= $headTemplate->render() ?>

    <h1>Bonjour le monde!</h1>

<?= $legsTemplate->render() ?>