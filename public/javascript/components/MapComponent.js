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
import { Component, State } from "../vendor/nova/nova.js";
import { SportTerrainService } from "../services/SportTerrainService.js";
import { CyclePathService } from "../services/CyclePathService.js";
import { PanelComponent } from "./PanelComponent.js";
export class MapComponent extends Component {
    constructor() {
        super(...arguments);
        this.loaded = false;
    }
    async onInit() {
        const [sportTerrains, cyclePaths] = await Promise.all([
            SportTerrainService.getList(),
            CyclePathService.getList()
        ]);
        this._sportTerrains = sportTerrains;
        this._cyclePaths = cyclePaths;
    }
    onAppear() {
        this._initMap();
        this._initMarkers();
        this._displaySportTerrains();
        this._displayCyclePaths();
        this.shouldUpdate = false;
        this.loaded = true;
    }
    render() {
        return `
            <div class="col-12 col-md-8 p-0 map-container">
                <div id="map" class="w-100 h-100 map"></div>
                <div class="map-legend bg-light rounded border shadow p-2">
                    <h2 class="fs-5 text-center">Légende</h2>
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                        <div class="sport-terrain-legend"></div>
                        <span>Terrain sportif</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                        <div class="cycle-path-legend"></div>
                        <span>Piste cyclable</span>
                    </div>
                </div>
            </div>
        `;
    }
    async _onSportTerrainClick(id) {
        const panelComponent = this.queryComponent(PanelComponent.definition.tag);
        if (panelComponent) {
            panelComponent.sportTerrain = await SportTerrainService.getById(id);
        }
    }
    _initMap() {
        this._map = L.map('map').setView([45.751258, -73.442155], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(this._map);
    }
    _initMarkers() {
        this._markers = L.markerClusterGroup({
            disableClusteringAtZoom: 12,
            spiderfyOnMaxZoom: false,
            showCoverageOnHover: false,
            iconCreateFunction: function (cluster) {
                let count = 0;
                for (const marker of cluster.getAllChildMarkers()) {
                    if (marker.sportTerrain) {
                        count++;
                    }
                }
                return L.divIcon({
                    html: '<b>' + count + '</b>',
                    className: 'p-2 w-auto h-auto text-center rounded-circle map-cluster-icon border shadow',
                });
            }
        });
    }
    _displaySportTerrains() {
        for (const sportTerrain of this._sportTerrains) {
            const marker = new L.Marker([sportTerrain.latitude, sportTerrain.longitude]);
            marker.bindPopup(sportTerrain.type);
            marker.on('click', () => {
                this._onSportTerrainClick(Number(sportTerrain.id)).then();
            });
            marker.sportTerrain = true;
            if (Number(sportTerrain.nb_events) > 0) {
                const numberMarker = L.marker([sportTerrain.latitude, sportTerrain.longitude], {
                    icon: L.divIcon({
                        className: 'custom-icon',
                        html: `<div class=\"bg-danger text-center rounded-circle text-white border border-black border-2 fw-bold\">${sportTerrain.nb_events}</div>`,
                        iconAnchor: [-5, 50],
                        iconSize: [20, 20]
                    })
                });
                this._markers.addLayer(numberMarker);
            }
            this._markers.addLayer(marker);
        }
        this._map.addLayer(this._markers);
    }
    _displayCyclePaths() {
        for (const cyclePath of this._cyclePaths) {
            const coordinates = JSON.parse(cyclePath.coordinates_json);
            const geoJsonFeature = {
                type: 'Feature',
                geometry: {
                    type: cyclePath.type,
                    coordinates: coordinates
                }
            };
            const geoJson = JSON.stringify(geoJsonFeature);
            L.geoJSON(JSON.parse(geoJson), {
                style: () => {
                    return {
                        color: "green",
                        weight: 3
                    };
                }
            }).addTo(this._map);
        }
    }
}
_a = MapComponent;
MapComponent.definition = _a.define("map-component");
__decorate([
    State,
    __metadata("design:type", Boolean)
], MapComponent.prototype, "loaded", void 0);