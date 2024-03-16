<div class="flex-grow-1 w-100 row m-0 border border-5">
    <div class="col-md-8 p-0 map-container">
        <div id="map" class="w-100 h-100 map"></div>
        <div class="map-legend bg-light rounded border shadow p-2">
            <h2 class="fs-5 text-center">Légende</h2>
            <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                <div class="sport-terrain-legend"></div>
                <span>Terrain sportif</span>
            </div>
            <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                <div class="cycle-path-legend"></div>
                <span>Piste cyclable</span>
            </div>
        </div>
    </div>
    <div class="col-md-4 overflow-auto py-3 map-panel" data-map-panel>
        <div class="alert alert-warning text-center on-top" role="alert">
            Sélectionner un marqueur pour voir les événements
        </div>
    </div>
</div>
<script type="module" src="/public/javascript/scripts/map.js"></script>