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

$cyclePaths = DatabaseService::query("SELECT * FROM cycle_path");

?>
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
        $events = DatabaseService::query("SELECT * FROM event WHERE sport_terrain_id = " . $sportTerrain['id']);
        echo "let marker" . $i . " = L.marker([" . $sportTerrain['latitude'] . "," . $sportTerrain['longitude'] . "]).addTo(markers);\n";
        echo "marker" . $i . ".bindPopup(\"" . $sportTerrain['type'] . "\");\n";
        if (count($events) > 0) {
            echo "L.marker([" . $sportTerrain['latitude'] . "," . $sportTerrain['longitude'] . "], {icon: L.divIcon({className: 'custom-icon', html: '<div class=\"bg-danger text-center rounded-circle text-white border border-black border-2 fw-bold\">" . count($events) . "</div>', iconAnchor: [-5, 50], iconSize: [20, 20]})}).addTo(numberMarkers);\n";
        }
        echo "marker" . $i . ".on('click', function (e) { WorldMap.onMarkerClick(" . $sportTerrain['id'] . ") });\n";
        $i++;
    }

    foreach ($cyclePaths as $cyclePath) {
        $coordinates = json_decode($cyclePath['coordinates_json'], true);
        $geoJsonFeature = [
            'type' => 'Feature',
            'geometry' => [
                'type' => $cyclePath['type'],
                'coordinates' => $coordinates
            ],
            'properties' => [
                'color' => 'green',
                'weight' => 3
            ]
        ];
        $geoJson = json_encode($geoJsonFeature);
        echo "L.geoJSON($geoJson, {
            style: function(feature) {
                return {
                    color: feature.properties.color,
                    weight: feature.properties.weight
                };
            }
        }).addTo(map);\n";
    }

    ?>
</script>
