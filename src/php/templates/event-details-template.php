<?php

/*
 * array $event: The event of the page
 */

require_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/src/php/services/DatabaseService.php");

function formatString($string): string
{
    return htmlspecialchars_decode(str_replace("&amp;#039;&amp;#039;", "'", $string));
}

if (!isset($event)) {
    exit;
}

$sportTerrain = DatabaseService::query("SELECT * FROM sport_terrain WHERE id = '" . $event['sport_terrain_id'] . "'");

if ($sportTerrain === null || sizeof($sportTerrain) === 0) {
    header('location: /views/home/');
}

$sportTerrain = $sportTerrain[0];

?>
<div class="mx-2">
    <div class="wrapper-md my-4 border border-2 bg-light rounded p-3">
        <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
            <button class="btn btn-secondary" onclick="history.back()">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <h2 class="text-break">
                <?= formatString($event['event_name']) ?>
            </h2>
            <form action="/views/event/" method="post">
                <button type="submit" name="deleteEvent" value="<?= formatString($event['id']) ?>"
                        class="btn btn-danger">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
        <hr>
        <div class="pb-2 text-break">
            <span class="fw-bold">Organisateur:</span> <?= formatString($event['organizer']) ?>
        </div>
        <div class="pb-2 text-break">
            <span class="fw-bold">Date:</span> <?= formatString($event['start_date']) ?>
            : <?= substr(formatString($event['start_time']), 0, 5) ?>
            à <?= formatString($event['start_date']) === formatString($event['end_date']) ? "" : formatString($event['end_date']) . " : " ?><?= substr(formatString($event['end_time']), 0, 5) ?>
        </div>
        <p class="text-break">
            <span class="fw-bold">Description:</span> <?= formatString($event['description']) ?>
        </p>
        <table class="table table-responsive table-striped on-top">
            <tbody>
            <tr>
                <th scope="row">Type de terrain</th>
                <td><?php echo formatString($sportTerrain['terrain']) ?>
                    - <?php echo formatString($sportTerrain['type']) ?></td>
            </tr>
            <?php if ($sportTerrain['flooring'] !== null): ?>
                <tr>
                    <th scope="row">Revêtement du sol</th>
                    <td><?php echo formatString($sportTerrain['flooring']) ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <th scope="row">Municipalité</th>
                <td><?php echo formatString($sportTerrain['city']) ?></td>
            </tr>
            <?php if ($sportTerrain['address'] !== null): ?>
                <tr>
                    <th scope="row">Adresse</th>
                    <td><?php echo formatString($sportTerrain['address']) ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($sportTerrain['parc'] !== null): ?>
                <tr>
                    <th scope="row">Parc</th>
                    <td><?php echo formatString($sportTerrain['parc']) ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <th scope="row">Longitude</th>
                <td><?php echo formatString($sportTerrain['longitude']) ?></td>
            </tr>
            <tr>
                <th scope="row">Latitude</th>
                <td><?php echo formatString($sportTerrain['latitude']) ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>