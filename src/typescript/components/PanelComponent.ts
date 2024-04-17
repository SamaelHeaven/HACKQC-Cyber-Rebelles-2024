import {Component, ComponentDefinition, State, Event, escape} from "../vendor/nova/nova.js";
import {SportTerrain} from "../models/SportTerrain.js";
import {SportEvent} from "../models/SportEvent.js";
import {SportEventService} from "../services/SportEventService.js";
import {MapComponent} from "./MapComponent.js";

export class PanelComponent extends Component {
    public static readonly definition: ComponentDefinition = this.define("panel-component");
    @State private _sportTerrain?: SportTerrain;
    @State private _section: "info" | "events" = "info";
    private _events: SportEvent[] = [];
    private _mapComponent: MapComponent;

    @Event("click")
    private readonly _onInfoClick = function (): void {
        this._section = "info";
    }.bind(this);

    @Event("click")
    private readonly _onEventsClick = function (): void {
        this._section = "events";
    }.bind(this);

    public get sportTerrain() {
        return this._sportTerrain;
    }

    public set sportTerrain(sportTerrain: SportTerrain) {
        SportEventService.getListBySportTerrainId(Number(sportTerrain.id)).then((events: SportEvent[]): void => {
            this._events = events;
            this._sportTerrain = sportTerrain;
        });
    }

    public override async onInit(): Promise<void> {
        while (!this._mapComponent) {
            this._mapComponent = this.queryComponent(MapComponent.definition.tag);
            await new Promise(r => setTimeout(r, 100));
        }

        this._mapComponent.subscribers.push([this as Component, "loaded"]);
    }

    public override render(): string {
        if (!this._mapComponent.loaded) {
            return "";
        }

        return `
            <div class="col-12 col-md-4 overflow-auto p-3 map-panel">
                ${this._sportTerrain ? this._renderPanel() : this._renderAlert()}
            </div>
        `;
    }

    private _renderAlert(): string {
        return `
            <div class="alert alert-warning text-center on-top" role="alert">
                Sélectionner un marqueur pour voir les événements
            </div>
        `;
    }

    private _renderPanel(): string {
        return `
            <div class="my-4">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <button ${this._onInfoClick.toString()} 
                                class="nav-link on-top${this._section === "info" ? " active" : ""}">
                                Info
                       </button>
                    </li>
                    <li class="nav-item">
                        <button ${this._onEventsClick.toString()} 
                                class="nav-link on-top${this._section === "events" ? " active" : ""}">
                            Événements
                        </button>
                    </li>
                </ul>
                <hr class="on-top">
                <div>
                    ${this._section === "info" ? this._renderInfo() : this._renderEvents()}
                </div>
            </div>
        `;
    }

    private _renderInfo(): string {
        return `
            <table class="table table-responsive table-striped on-top">
                <tbody>
                    <tr>
                        <th scope="row">Type de terrain</th>
                        <td>${this._sportTerrain.terrain} - ${this._sportTerrain.type}</td>
                    </tr>
                    ${(this._sportTerrain.flooring === null ? "" : `        
                    <tr>
                        <th scope="row">Revêtement du sol</th>
                        <td>${this._sportTerrain.flooring}</td>
                    </tr>`)}
                    <tr>
                        <th scope="row">Municipalité</th>
                        <td>${this._sportTerrain.city}</td>
                    </tr>
                    ${(this._sportTerrain.address === null ? "" : `        
                    <tr>
                        <th scope="row">Adresse</th>
                        <td>${this._sportTerrain.address}</td>
                    </tr>`)}
                    ${(this._sportTerrain.parc === null ? "" : `        
                    <tr>
                        <th scope="row">Parc</th>
                        <td>${this._sportTerrain.parc}</td>
                    </tr>`)}
                    <tr>
                        <th scope="row">Longitude</th>
                        <td>${this._sportTerrain.longitude}</td>
                    </tr>
                    <tr>
                        <th scope="row">Latitude</th>
                        <td>${this._sportTerrain.latitude}</td>
                    </tr>
                    ${(this._sportTerrain.creation_date === null ? "" : `        
                    <tr>
                        <th scope="row">Date de création</th>
                        <td>${this._sportTerrain.creation_date}</td>
                    </tr>`)}
                    ${(this._sportTerrain.modification_date === null ? "" : `        
                    <tr>
                        <th scope="row">Date de modification</th>
                        <td>${this._sportTerrain.modification_date.toString().substring(0, this._sportTerrain.modification_date.toString().length - 3)}</td>
                    </tr>`)}
                </tbody>
            </table>
        `;
    }

    private _renderEvents(): string {
        function formatString(str: string): string {
            return escape(str.replace(/&amp;#039;&amp;#039;/g, "'"));
        }

        let result: string = "<div class='mb-3'>";
        result += `<a class="btn btn-secondary on-top w-100 fs-4 fw-bold" href="/public/views/add-event/?terrainId=${this._sportTerrain.id}"><i class="fa-solid fa-plus"></i> Ajouter un événement</a>`;
        for (const event of this._events) {
            result += `
                <a class="border rounded p-3 text-decoration-none text-black border border-2 mt-3 w-100 fw-bold d-flex justify-content-between align-items-center gap-3 flex-wrap event-button on-top bg-white text-break" href="/public/views/event/?id=${formatString(event.id)}">
                    <span>${formatString(event.organizer)} - ${formatString(event.event_name)}</span>
                    <span>${formatString(event.start_date.toString())}</span>
                </a>
            `;
        }
        if (this._events.length === 0) {
            result += `
                <div class="alert alert-info mt-3 on-top text-center" role="alert">
                    Aucun événement n'est associé à ce terrain
                </div>
            `;
        }
        result += "</div>";
        return result;
    }
}