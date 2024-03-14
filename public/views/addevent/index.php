<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/models/Template.php");
require_once $_SERVER["DOCUMENT_ROOT"] . "/src/php/models/CurrentPage.php";

$headTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/head-template.php");
$headTemplate->setVariable("title", "FitQuest - About");
$headTemplate->setVariable("currentPage", CurrentPage::About);

$formTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/addEventForm-template.php");

$legsTemplate = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/legs-template.php");

?>
<?= $headTemplate->render() ?>

<div class="d-flex justify-content-center mt-3 ">
    <h1>Ajout d'événement</h1>
</div>

<form class="m-4" action="" method="post">
    <?= $formTemplate->render() ?>
</form>

<?= $legsTemplate->render() ?>
