<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/services/DatabaseService.php");

$jsonData = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/datasets/terrain_sportif.json");
$sportTerrains = json_decode($jsonData, true);

foreach ($sportTerrains as $terrain) {
    $dateCreation = substr($terrain['DATE_CREATION'], 0, 4) . '-' . substr($terrain['DATE_CREATION'], 4, 2) . '-' . substr($terrain['DATE_CREATION'], 6, 2);

    $dateModification = substr($terrain['DATE_MODIFICATION'], 0, 4) . '-' . substr($terrain['DATE_MODIFICATION'], 4, 2) . '-' . substr($terrain['DATE_MODIFICATION'], 6, 2) . ' ' . substr($terrain['DATE_MODIFICATION'], 8, 2) . ':' . substr($terrain['DATE_MODIFICATION'], 10, 2) . ':' . substr($terrain['DATE_MODIFICATION'], 12, 2);

    $query = "
        INSERT INTO sport_terrain 
            (terrain, id, type, flooring, city, creation_date, modification_date, longitude, latitude) 
        VALUES (
            '{$terrain['json_featuretype']}',
            {$terrain['ID']},
            '{$terrain['TYPE']}',
            '{$terrain['REVETEMENT_SOL']}',
            '{$terrain['MUNICIPALITE']}',
            '$dateCreation',
            '$dateModification', 
            {$terrain['LONGITUDE']},
            {$terrain['LATITUDE']}
        )";

    DatabaseService::query($query);
}