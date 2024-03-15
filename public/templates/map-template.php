<?php

/*
* double $latitude: The latitude of the page
* double $longitude: The longitude of the page
* double $zoom: The zoom of the page
* string $jsPath: The path to the javascript folder
*/

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/services/DatabaseService.php");

$latitude ??= 0;
$longitude ??= 0;
$zoom ??= 13;
$jsPath ??= "../../javascript";

$sportTerrains = DatabaseService::query("SELECT * FROM sport_terrain");

?>
<div class="flex-grow-1 w-100 row m-0 border border-5">
    <div class="col-md-8 p-0">
        <div id="map" class="w-100 h-100" style="min-height: 400px"></div>
    </div>
    <div class="col-md-4 overflow-auto py-3 map-panel" data-map-panel>
        <div class="alert alert-warning text-center onTop" role="alert">
            Sélectionner un marqueur pour voir les événements
        </div>
    </div>
</div>

<script type="module">
    <?= ("import { WorldMap } from \"" . $jsPath . "/WorldMap.js\";") ?>

    let map = L.map('map').setView([<?= $latitude ?>, <?= $longitude?>], <?= $zoom ?>);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    let markers = L.layerGroup().addTo(map);
    let numberMarkers = L.layerGroup().addTo(map);

    <?php

    $i = 0;
    foreach ($sportTerrains as $sportTerrain) {
        $events = DatabaseService::query("SELECT * FROM event WHERE sport_terrain_id = ". $sportTerrain['id']);
        echo "let marker" . $i . " = L.marker([" . $sportTerrain['latitude'] . "," . $sportTerrain['longitude'] . "]).addTo(markers);\n";
        echo "marker" . $i . ".bindPopup('" . $sportTerrain['type'] . "');\n";
        if (count($events) > 0) {
            echo "L.marker([" . $sportTerrain['latitude'] . "," . $sportTerrain['longitude'] . "], {icon: L.divIcon({className: 'custom-icon', html: '<div class=\"bg-danger text-center rounded-circle text-white border border-black border-2 fw-bold\">". count($events) ."</div>', iconAnchor: [-5, 50], iconSize: [20, 20]})}).addTo(numberMarkers);\n";
        }
        echo "marker" . $i . ".on('click', function (e) { WorldMap.onMarkerClick(" . $sportTerrain['id'] . ") });\n";
        $i++;
    }
    ?>
</script>
