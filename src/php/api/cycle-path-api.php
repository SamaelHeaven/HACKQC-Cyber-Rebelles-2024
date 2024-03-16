<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/src/php/services/DatabaseService.php");

$list = $_GET["list"] ?? null;

if ($list === null) {
    exit;
}

$result = DatabaseService::query("SELECT * FROM cycle_path");

echo json_encode($result);