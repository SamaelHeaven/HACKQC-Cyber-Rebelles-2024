<?php

function titleCase($string): string
{
    $firstChar = mb_substr($string, 0, 1);
    $restChars = mb_substr($string, 1);
    $restCharsLower = mb_strtolower($restChars);
    return $firstChar . $restCharsLower;
}

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/services/DatabaseService.php");

$jsonData = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/datasets/terrain_sportif.json");
$sportTerrains = json_decode($jsonData, true);

foreach ($sportTerrains as $terrain) {
    $dateCreation = substr($terrain['DATE_CREATION'], 0, 4) . '-' . substr($terrain['DATE_CREATION'], 4, 2) . '-' . substr($terrain['DATE_CREATION'], 6, 2);
    $dateModification = substr($terrain['DATE_MODIFICATION'], 0, 4) . '-' . substr($terrain['DATE_MODIFICATION'], 4, 2) . '-' . substr($terrain['DATE_MODIFICATION'], 6, 2) . ' ' . substr($terrain['DATE_MODIFICATION'], 8, 2) . ':' . substr($terrain['DATE_MODIFICATION'], 10, 2) . ':' . substr($terrain['DATE_MODIFICATION'], 12, 2);

    $query = "
        INSERT INTO sport_terrain 
            (terrain, type, flooring, city, creation_date, modification_date, longitude, latitude) 
        VALUES (
            '{$terrain['json_featuretype']}',
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

$jsonData = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/datasets/sagarenastade.json");
$sportTerrains = json_decode($jsonData, true);

foreach ($sportTerrains['features'] as $terrain) {
    $properties = $terrain['properties'];
    $coordinates = $terrain['geometry']['coordinates'];
    $address = DatabaseService::escapeString($properties['adresse_texte']);

    $query = "
        INSERT INTO sport_terrain 
            (terrain, type, city, address, longitude, latitude) 
        VALUES (
            'Terrain sportif',
            '{$properties['type_instal']}',
            'Saguenay',
            '$address',
            '$coordinates[0]',
            '$coordinates[1]'
        )";

    DatabaseService::query($query);
}

$jsonData = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/datasets/saginfrastructuresportiverecreativeexterieure.json");
$sportTerrains = json_decode($jsonData, true);

foreach ($sportTerrains['features'] as $terrain) {
    $properties = $terrain['properties'];
    if ($properties['TYPE_INSTALLATION'] === "MODULE DE JEUX" || $properties['TYPE_INSTALLATION'] === "AIRE DE JEUX") {
        continue;
    }
    $coordinates = $terrain['geometry']['coordinates'];
    $parc = titleCase(trim(DatabaseService::escapeString($properties['PARC'])));
    $type = trim(titleCase(DatabaseService::escapeString(explode(" -", $properties['DESCRIPTION'])[0])));

    if ($type === "") {
        $type = titleCase(DatabaseService::escapeString($properties['TYPE_INSTALLATION']));
    }

    $query = "
        INSERT INTO sport_terrain 
            (terrain, type, city, parc, longitude, latitude) 
        VALUES (
            'Terrain sportif',
            '$type',
            'Saguenay',
            '$parc',
            '$coordinates[0]',
            '$coordinates[1]'
        )";

    DatabaseService::query($query);
}