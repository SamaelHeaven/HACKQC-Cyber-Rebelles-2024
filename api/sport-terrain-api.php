<?php

$id = $_GET["id"] ?? null;

if ($id == null) {
    exit;
}

require_once($_SERVER["DOCUMENT_ROOT"]. "/src/php/services/DatabaseService.php");

$sportTerrains = DatabaseService::query("SELECT * FROM sport_terrain WHERE id = '" . DatabaseService::escapeString($id) . "'");

$json = json_encode($sportTerrains[0]);

echo $json;