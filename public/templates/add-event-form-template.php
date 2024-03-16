<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/services/DatabaseService.php");

$detectError ??= true;

$errorMessage ??= "";
$terrainId ??= "";

$organizer ??= "";
$eventName ??= "";
$description ??= "";
$startDate ??= "";
$endDate ??= "";
$startTime ??= "";
$endTime ??= "";
$success ??= false;

$validDate ??= false;
$validTime ??= false;

if (!($organizer == "" ||
    $eventName == "" ||
    $description == "" ||
    $startDate == "" ||
    $endDate == "" ||
    $startTime == "" ||
    $endTime == "")) {

    if ($startDate <= $endDate) {
        $validDate = true;
        if (!($startDate == $endDate && $startTime >= $endTime)) {
            $validTime = true;
            DatabaseService::query("INSERT INTO event (sport_terrain_id, organizer, event_name, description, start_date, end_date, start_time, end_time) VALUES ('" . htmlspecialchars(DatabaseService::escapeString($terrainId)) . "','" . htmlspecialchars(DatabaseService::escapeString($organizer)) . "','" . htmlspecialchars(DatabaseService::escapeString($eventName)) . "','" . htmlspecialchars(DatabaseService::escapeString($description)) . "','" . htmlspecialchars(DatabaseService::escapeString($startDate)) . "','" . htmlspecialchars(DatabaseService::escapeString($endDate)) . "','" . htmlspecialchars(DatabaseService::escapeString($startTime)) . "','" . htmlspecialchars(DatabaseService::escapeString($endTime)) . "')");
            $success = true;
            $organizer = "";
            $eventName = "";
            $description = "";
            $startDate = "";
            $endDate = "";
            $startTime = "";
            $endTime = "";
        } else {
            $errorMessage = "L'événement ne peut pas se terminer avant d'avoir commencé";
        }
    } else {
        $errorMessage = "La date de fin ne peut pas être avant la date de début";
    }

} else {
    if ($detectError) {
        $errorMessage = "Un ou plusieurs champs n'ont pas été rempli";
    }
}
$validCss = "is-valid";
$invalidCss = "is-invalid";
?>

<div class="wrapper-md">
    <div class="d-flex justify-content-center mt-3 mb-4 ">
        <h1>Ajout d'événement</h1>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="organizer">Organisateur</label>
            <input class="form-control d-block w-100 <?php if ($errorMessage != "") {
                echo $organizer != "" ? $validCss : $invalidCss;
            } ?>  " type="text" id="organizer" name="organizer" value="<?= $organizer ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="eventName">Nom de l'événement</label>
            <input class="form-control d-block w-100 <?php if ($errorMessage != "") {
                echo $eventName != "" ? $validCss : $invalidCss;
            } ?>" type="text" id="eventName" name="eventName" value="<?= $eventName ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea class="form-control d-block w-100 <?php if ($errorMessage != "") {
                echo $description != "" ? $validCss : $invalidCss;
            } ?>" name="description" id="description" cols="30" rows="10"><?= $description ?></textarea>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <label class="form-label" for="startDate">Date de début</label>
            <input class="form-control d-block <?php if ($errorMessage != "") {
                echo $validDate ? $validCss : $invalidCss;
            } ?>" type="date" id="startDate" name="startDate" value="<?= $startDate ?>">
        </div>
        <div class="col-6 col-md-3 mb-3">
            <label class="form-label" for="endDate">Date de fin</label>
            <input class="form-control d-block <?php if ($errorMessage != "") {
                echo $validDate ? $validCss : $invalidCss;
            } ?>" type="date" id="endDate" name="endDate" value="<?= $endDate ?>">
        </div>
        <div class="col-6 col-md-3 mb-3">
            <label class="form-label" for="startTime">Heure de départ</label>
            <input class="form-control d-block <?php if ($errorMessage != "") {
                echo $validTime ? $validCss : $invalidCss;
            } ?>" type="time" id="startTime" name="startTime" value="<?= $startTime ?>">
        </div>
        <div class="col-6 col-md-3 mb-4">
            <label class="form-label" for="endTime">Heure de fin</label>
            <input class="form-control d-block <?php if ($errorMessage != "") {
                echo $validTime ? $validCss : $invalidCss;
            } ?>" type="time" id="endTime" name="endTime" value="<?= $endTime ?>">
        </div>

        <div class="d-flex align-items-center flex-wrap gap-3 justify-content-between w-100 mt-1 mb-3 col">

            <div>
                <?php
                if ($errorMessage != "") {
                    ?>
                    <div class="alert alert-danger mb-0" role="alert">
                        <p class="text-center m-0"><i
                                    class="fa-solid fa-circle-exclamation pe-2"></i><?= $errorMessage ?></p>
                    </div>
                    <?php
                } else if ($success) {
                    ?>
                    <div class="alert alert-success mb-0" role="alert">
                        <p class="text-center m-0"><i class="fa-regular fa-circle-check pe-2"></i>
                            L'événement a été ajouté avec succès
                        </p>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div>
                <input class="btn btn-primary" type="submit" value="Ajouter l'événement">
            </div>
        </div>
        <input type="hidden" value="<?= $terrainId ?>" name="terrainId">
    </div>
</div>
