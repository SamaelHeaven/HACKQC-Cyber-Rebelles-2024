<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/services/DatabaseService.php");

$list = $_GET["list"] ?? null;

if ($list !== null) {
    $result = DatabaseService::query("SELECT st.*, COUNT(e.id) AS nb_events 
                                      FROM sport_terrain st
                                      LEFT JOIN event e ON st.id = e.sport_terrain_id 
                                      GROUP BY st.id");

    echo json_encode($result);

    exit;
}

$id = $_GET["id"] ?? null;

if ($id === null) {
    exit;
}

$sportTerrains = DatabaseService::query("SELECT * FROM sport_terrain WHERE id = '" . DatabaseService::escapeString($id) . "'");

$result = null;

if ($sportTerrains !== null && count($sportTerrains) === 1) {
    $result = $sportTerrains[0];
}

if ($result !== null) {
    $nbEvents = DatabaseService::query("SELECT COUNT(*) FROM event WHERE sport_terrain_id = '" . DatabaseService::escapeString($id) . "'");
    $result["nb_events"] = $nbEvents[0]["count"];
}

echo json_encode($result);