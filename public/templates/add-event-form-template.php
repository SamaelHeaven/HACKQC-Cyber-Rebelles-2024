<?php
$detectError ??= true;

$errorMessage ??= "";
$terrainId ??= "";

$organizer ??= "";
$eventName ??= "";
$description ??= "";
$dateStart ??= "";
$dateEnd ??= "";
$timeStart ??= "";
$timeEnd ??= "";
$success ??= false;

$validedate ??= false;
$validetime ??= false;

if (!($organizer == "" ||
    $eventName == "" ||
    $description == "" ||
    $dateStart == "" ||
    $dateEnd == "" ||
    $timeStart == "" ||
    $timeEnd == "")) {

    if ($dateStart <= $dateEnd){
        $validedate = true;
        if (!($dateStart == $dateEnd && $timeStart >= $timeEnd)){
            $validetime = true;
            DatabaseService::query("INSERT INTO event(sport_terrain_id, organizer, eventname, description, datestart, dateend, timestart, timeend) values('$terrainId','$organizer','$eventName','$description','$dateStart','$dateEnd','$timeStart','$timeEnd') ");
            $success = true;
            $organizer = "";
            $eventName = "";
            $description = "";
            $dateStart = "";
            $dateEnd = "";
            $timeStart = "";
            $timeEnd = "";
        } else {
            $errorMessage = "L'événement ne peut pas se terminer avant d'avoir commencé ";
        }
    } else {
        $errorMessage = "La date de fin ne peut pas être avant la date de début ";
    }

} else {
    if ($detectError) {
        $errorMessage = "L'un des champs n'a pas été rempli";
    }
}
$cssValide = "is-valid";
$cssinValide = "is-invalid";
?>

<div class="wrapper-md">
    <div class="d-flex justify-content-center mt-5 mb-4 ">
        <h1>Ajout d'événement</h1>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="organizer">Organisateur</label>
            <input class="form-control d-block w-100 <?php if ($errorMessage != "" ){ echo $organizer != "" ? $cssValide : $cssinValide ;} ?>  " type="text" id="organizer" name="organizer" value="<?= $organizer ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="eventName">Nom de l'événement</label>
            <input class="form-control d-block w-100 <?php if ($errorMessage != ""){ echo $eventName != "" ? $cssValide : $cssinValide ;} ?>" type="text" id="eventName" name="eventName" value="<?= $eventName ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea class="form-control d-block w-100 <?php if ($errorMessage != ""){ echo $description != "" ? $cssValide : $cssinValide ;} ?>" name="description" id="description" cols="30" rows="10"><?= $description ?></textarea>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <label class="form-label" for="dateStart">Date de début</label>
            <input class="form-control d-block <?php if ($errorMessage != ""){ echo $validedate ? $cssValide : $cssinValide ;} ?>" type="date" id="dateStart" name="dateStart" value="<?= $dateStart ?>">
        </div>
        <div class="col-6 col-md-3 mb-3">
            <label class="form-label" for="dateEnd">Date de fin</label>
            <input class="form-control d-block <?php if ($errorMessage != ""){ echo $validedate ? $cssValide : $cssinValide ;} ?>" type="date" id="dateEnd" name="dateEnd" value="<?= $dateEnd ?>">
        </div>
        <div class="col-6 col-md-3 mb-3">
            <label class="form-label" for="timeStart">Heure de départ</label>
            <input class="form-control d-block <?php if ($errorMessage != ""){ echo $validetime ? $cssValide : $cssinValide ;} ?>" type="time" id="timeStart" name="timeStart" value="<?= $timeStart ?>">
        </div>
        <div class="col-6 col-md-3 mb-4">
            <label class="form-label" for="timeEnd">Heure de fin</label>
            <input class="form-control d-block <?php if ($errorMessage != ""){ echo $validetime ? $cssValide : $cssinValide ;} ?>" type="time" id="timeEnd" name="timeEnd" value="<?= $timeEnd ?>">
        </div>

        <div class="d-flex align-items-center flex-wrap gap-3 justify-content-between w-100 mt-3 mb-5 col">

            <div>
                <?php
                    if ($errorMessage != ""){
                ?>
                <div class="alert alert-danger mb-0" role="alert">
                    <p class="text-center m-0"><i class="fa-solid fa-circle-exclamation pe-3"></i><?= $errorMessage ?></p>
                </div>
                <?php
                    } else if ($success) {
                ?>
                <div class="alert alert-success mb-0" role="alert">
                    <p class="text-center m-0"> <i class="fa-regular fa-circle-check pe-3"></i> L'événement est ajouté avec succès </p>
                </div>
                <?php
                    }
                ?>
            </div>
            <div>
                <input class="btn btn-primary" type="submit" value="Ajouter l'événement">
            </div>
        </div>
        <input type="hidden" value="<?=$terrainId ?>" name="terrainId">

    </div>
</div>
