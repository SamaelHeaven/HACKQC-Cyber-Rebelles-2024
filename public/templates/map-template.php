<?php

/*
* double $latitude: The latitude of the page
* double $longitude: The longitude of the page
* double $zoom: The zoom of the page
*/

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/services/DatabaseService.php");

$latitude ??= 0;
$longitude ??= 0;
$zoom ??= 12;

$sportTerrains = DatabaseService::query("SELECT * FROM sport_terrain");

?>
<div id="map" class="w-100 flex-grow-1 map"></div>
<script>
    let map = L.map('map').setView([<?= $latitude ?>, <?= $longitude?>], <?= $zoom ?>);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    <?php
    foreach ($sportTerrains as $sportTerrain) {
        echo "L.marker([" . $sportTerrain['latitude'] . "," . $sportTerrain['longitude'] . "]).addTo(map);;";
    }
    ?>
</script>