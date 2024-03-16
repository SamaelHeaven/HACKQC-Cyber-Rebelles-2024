<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/services/DatabaseService.php");

$jsonData = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/datasets/piste_cyclable.json");
$cyclePaths = json_decode($jsonData, true);

foreach ($cyclePaths as $cyclePath) {
    $coordinates = json_encode($cyclePath['json_geometry']['coordinates']);
    $type = $cyclePath['json_geometry']['type'];
    $query = "
        INSERT INTO cycle_path 
            (type, coordinates_json) 
        VALUES (
            '$type',
            '$coordinates'
        )";

    DatabaseService::query($query);
}

$jsonData = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/datasets/sag_pistecyclable.json");
$cyclePaths = json_decode($jsonData, true);

foreach ($cyclePaths['features'] as $cyclePath) {
    $coordinates = json_encode($cyclePath['geometry']['coordinates']);
    $type = $cyclePath['geometry']['type'];
    $query = "
        INSERT INTO cycle_path 
            (type, coordinates_json) 
        VALUES (
            '$type',
            '$coordinates'
        )";

    DatabaseService::query($query);
}