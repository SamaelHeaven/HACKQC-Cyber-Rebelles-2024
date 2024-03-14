<?php
$errorMessage ??= "";

?>

<div class="container">
    <div class="mt-5 mb-4 ">
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
        <div class="d-flex justify-content-start mb-3">
            <input class="btn btn-primary" type="submit" value="Ajouter l'événement">
        </div>
        <?php
        if ($errorMessage != ""){
            ?>
            <div class="d-flex justify-content-center mt-3">
                <p><?= $errorMessage ?></p>
            </div>

            <?php
        }
        ?>
    </div>
</div>