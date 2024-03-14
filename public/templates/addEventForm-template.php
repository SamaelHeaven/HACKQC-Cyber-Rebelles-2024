<div class="container">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="company">Organisateur</label>
            <input class="form-control d-block w-100" type="text" id="company">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="eventName">Nom de l'événement</label>
            <input class="form-control d-block w-100" type="text" id="eventName">
        </div>
        <div class="mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea class="form-control d-block w-100" name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <label class="form-label" for="dateStart">Date de début</label>
            <input class="form-control d-block" type="date" id="dateStart">
        </div>
        <div class="col-6 col-md-3 mb-3">
            <label class="form-label" for="dateEnd">Date de fin</label>
            <input class="form-control d-block" type="date" id="dateEnd">
        </div>
        <div class="col-6 col-md-3 mb-3">
            <label class="form-label" for="timeStart">Heure de départ</label>
            <input class="form-control d-block" type="time" id="timeStart">
        </div>
        <div class="col-6 col-md-3 mb-5">
            <label class="form-label" for="timeEnd">Heure de fin</label>
            <input class="form-control d-block" type="time" id="timeEnd">
        </div>
        <div class="d-flex justify-content-start mb-3">
            <input class="btn btn-primary" type="submit" value="Ajouter l'événement">
        </div>
    </div>
</div>