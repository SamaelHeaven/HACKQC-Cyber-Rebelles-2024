export class Template {
    static getMapPanel(sportTerrain) {
        return `
        <div class="my-4">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <button data-nav-link="info" class="nav-link active on-top">Info</button>
                </li>
                <li class="nav-item">
                    <button data-nav-link="events" class="nav-link on-top">Événements</button>
                </li>
            </ul>
            <hr class="on-top">
            <div data-map-panel-section="${sportTerrain.id}">
                ${Template.getInfoPanel(sportTerrain)}
            </div>
        </div>
        `;
    }
    static getInfoPanel(sportTerrain) {
        return `
            <table class="table table-responsive table-striped on-top">
                <tbody>
                    <tr>
                        <th scope="row">Type de terrain</th>
                        <td>${sportTerrain.terrain} - ${sportTerrain.type}</td>
                    </tr>
                    ${(sportTerrain.flooring === null ? "" : `        
                    <tr>
                        <th scope="row">Revêtement du sol</th>
                        <td>${sportTerrain.flooring}</td>
                    </tr>`)}
                    <tr>
                        <th scope="row">Municipalité</th>
                        <td>${sportTerrain.city}</td>
                    </tr>
                    ${(sportTerrain.address === null ? "" : `        
                    <tr>
                        <th scope="row">Adresse</th>
                        <td>${sportTerrain.address}</td>
                    </tr>`)}
                    <tr>
                        <th scope="row">Longitude</th>
                        <td>${sportTerrain.longitude}</td>
                    </tr>
                    <tr>
                        <th scope="row">Latitude</th>
                        <td>${sportTerrain.latitude}</td>
                    </tr>
                    ${(sportTerrain.creation_date === null ? "" : `        
                    <tr>
                        <th scope="row">Date de création</th>
                        <td>${sportTerrain.creation_date}</td>
                    </tr>`)}
                    ${(sportTerrain.modification_date === null ? "" : `        
                    <tr>
                        <th scope="row">Date de modification</th>
                        <td>${sportTerrain.modification_date.toString().substring(0, sportTerrain.modification_date.toString().length - 3)}</td>
                    </tr>`)}
                </tbody>
            </table>
        `;
    }
    static getEventsPanel(sportTerrain, events) {
        let result = "<div class='mb-3'>";
        result += `<a class="btn btn-secondary on-top w-100 fs-4 fw-bold" href="/public/views/add-event/?terrainId=${sportTerrain.id}"><i class="fa-solid fa-plus"></i> Ajouter un événement</a>`;
        for (let event of events) {
            result += `
                <a class="border rounded p-3 text-decoration-none text-black border border-2 mt-3 w-100 fw-bold d-flex justify-content-between align-items-center gap-3 flex-wrap event-button on-top bg-white" href="/public/views/event/?id=${event.id}">
                    <span>${event.organizer} - ${event.event_name}</span>
                    <span>${event.start_date}</span>
                </a>
            `;
        }
        if (events.length === 0) {
            result += `
                <div class="alert alert-info mt-3 on-top text-center" role="alert">
                    Aucun événements n'est associé à ce terrain
                </div>
            `;
        }
        result += "</div>";
        return result;
    }
}
