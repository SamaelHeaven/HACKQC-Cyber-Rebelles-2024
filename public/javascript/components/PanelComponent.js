var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var _a;
import { Component, State, Event, escape } from "../vendor/nova/nova.js";
import { SportEventService } from "../services/SportEventService.js";
import { MapComponent } from "./MapComponent.js";
export class PanelComponent extends Component {
    constructor() {
        super(...arguments);
        this._section = "info";
        this._events = [];
        this._onInfoClick = function () {
            this._section = "info";
        }.bind(this);
        this._onEventsClick = function () {
            this._section = "events";
        }.bind(this);
    }
    get sportTerrain() {
        return this._sportTerrain;
    }
    set sportTerrain(sportTerrain) {
        SportEventService.getListBySportTerrainId(Number(sportTerrain.id)).then((events) => {
            this._events = events;
            this._sportTerrain = sportTerrain;
        });
    }
    async onInit() {
        while (!this._mapComponent) {
            this._mapComponent = this.queryComponent(MapComponent.definition.tag);
            await new Promise(r => setTimeout(r, 50));
        }
        this._mapComponent.subscribers.push([this, "loaded"]);
    }
    render() {
        if (!this._mapComponent.loaded) {
            return "";
        }
        return `
            <div class="col-12 col-md-4 overflow-auto p-3 map-panel">
                ${this._sportTerrain ? this._renderPanel() : this._renderAlert()}
            </div>
        `;
    }
    _renderAlert() {
        return `
            <div class="alert alert-warning text-center on-top" role="alert">
                Sélectionner un marqueur pour voir les événements
            </div>
        `;
    }
    _renderPanel() {
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
    _renderInfo() {
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
                        <td>${this._sportTerrain.modification_date.substring(0, this._sportTerrain.modification_date.length - 3)}</td>
                    </tr>`)}
                </tbody>
            </table>
        `;
    }
    _renderEvents() {
        function format(str) {
            return escape(str.replace(/&amp;#039;&amp;#039;/g, "'"));
        }
        let result = "<div class='mb-3'>";
        result += `
            <a class="btn btn-secondary on-top w-100 fs-4 fw-bold" href="/views/add-event/?terrainId=${this._sportTerrain.id}">
                <i class="fa-solid fa-plus"></i> 
                Ajouter un événement
            </a>
        `;
        for (const event of this._events) {
            result += `
                <a class="border rounded p-3 text-decoration-none text-black border border-2 mt-3 w-100 fw-bold d-flex justify-content-between align-items-center gap-3 flex-wrap event-button on-top bg-white text-break" href="/views/event/?id=${format(event.id)}">
                    <span>${format(event.organizer)} - ${format(event.event_name)}</span>
                    <span>${format(event.start_date)}</span>
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
_a = PanelComponent;
PanelComponent.definition = _a.define("panel-component");
__decorate([
    State,
    __metadata("design:type", Object)
], PanelComponent.prototype, "_sportTerrain", void 0);
__decorate([
    State,
    __metadata("design:type", String)
], PanelComponent.prototype, "_section", void 0);
__decorate([
    Event("click"),
    __metadata("design:type", Object)
], PanelComponent.prototype, "_onInfoClick", void 0);
__decorate([
    Event("click"),
    __metadata("design:type", Object)
], PanelComponent.prototype, "_onEventsClick", void 0);
