import {SportTerrain} from "./SportTerrain.js";

export class Template {
    public static getMapPanel(sportTerrain: SportTerrain): string {
        return `
        <div class="my-4">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <button data-nav-link="info" class="nav-link active">Info</button>
                </li>
                <li class="nav-item">
                    <button data-nav-link="events" class="nav-link">Événements</button>
                </li>
            </ul>
            <hr>
            <div data-map-panel-section="${sportTerrain.id}">
                ${Template.getInfoPanel(sportTerrain)}
            </div>
        </div>
        `;
    }

    public static getInfoPanel(sportTerrain: SportTerrain): string {
        return `
            <table class="table table-responsive table-striped">
                <tbody>
                    <tr>
                        <th scope="row">Type de terrain</th>
                        <td>${sportTerrain.json_featuretype} - ${sportTerrain.type}</td>
                    </tr>
                    <tr>
                        <th scope="row">Revêtement du sol</th>
                        <td>${sportTerrain.revetement_sol}</td>
                    </tr>
                    <tr>
                        <th scope="row">Municipalité</th>
                        <td>${sportTerrain.municipalite}</td>
                    </tr>
                    <tr>
                        <th scope="row">Longitude</th>
                        <td>${sportTerrain.longitude}</td>
                    </tr>
                    <tr>
                        <th scope="row">Latitude</th>
                        <td>${sportTerrain.latitude}</td>
                    </tr>
                    <tr>
                        <th scope="row">Date de création</th>
                        <td>${sportTerrain.date_creation}</td>
                    </tr>
                    <tr>
                        <th scope="row">Date de modification</th>
                        <td>${sportTerrain.date_modification}</td>
                    </tr>
                </tbody>
            </table>
        `;
    }
}