<?php

/*
* double $latitude: The latitude of the page
* double $longitude: The longitude of the page
*/

$latitude ??= 0;
$longitude ??= 0;

?>
<div id="map" class="w-100 flex-grow-1 map"></div>
<script>
    let map = L.map('map').setView([<?= $latitude ?>, <?= $longitude?>], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
</script>