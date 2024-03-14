<?php
$errorMessage ??= "";
$terrainId ??= "";
?>

<div class="wrapper-md">
    <div class="d-flex justify-content-center mt-5 mb-4 ">
        <h1>Ajout d'événement</h1>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="organizer">Organisateur</label>
            <input class="form-control d-block w-100" type="text" id="organizer" name="organizer">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="eventName">Nom de l'événement</label>
            <input class="form-control d-block w-100" type="text" id="eventName" name="eventName">
        </div>
        <div class="mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea class="form-control d-block w-100" name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <label class="form-label" for="dateStart">Date de début</label>
            <input class="form-control d-block" type="date" id="dateStart" name="dateStart">
        </div>
        <div class="col-6 col-md-3 mb-3">
            <label class="form-label" for="dateEnd">Date de fin</label>
            <input class="form-control d-block" type="date" id="dateEnd" name="dateEnd">
        </div>
        <div class="col-6 col-md-3 mb-3">
            <label class="form-label" for="timeStart">Heure de départ</label>
            <input class="form-control d-block" type="time" id="timeStart" name="timeStart">
        </div>
        <div class="col-6 col-md-3 mb-4">
            <label class="form-label" for="timeEnd">Heure de fin</label>
            <input class="form-control d-block" type="time" id="timeEnd" name="timeEnd">
        </div>

        <div class="d-flex align-items-center flex-wrap gap-3 justify-content-between w-100 mt-3 mb-5 col">

            <div>
            <?php
            if ($errorMessage != ""){
                ?>
                <div class="alert alert-danger mb-0" role="alert">
                    <p class="text-center m-0"><?= $errorMessage ?></p>
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
