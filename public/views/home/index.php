<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/models/Template.php");

$head_template = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/head-template.php");
$head_template->set_variable("title", "HackQC");

$legs_template = new Template($_SERVER["DOCUMENT_ROOT"] . "/public/templates/legs-template.php");

?>
<?= $head_template->render() ?>

    <h1>Bonjour le monde!</h1>

<?= $legs_template->render() ?>