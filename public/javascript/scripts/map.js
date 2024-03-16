var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { SportTerrainService } from "../services/SportTerrainService.js";
import { Template } from "../helpers/Template.js";
import { CyclePathService } from "../services/CyclePathService.js";
const map = L.map('map').setView([45.751258, -73.442155], 13);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
const markers = L.layerGroup().addTo(map);
const numberMarkers = L.layerGroup().addTo(map);
const icon = new L.Icon.Default();
icon.options.shadowSize = [0, 0];
loadSportTerrains().then();
loadCyclePaths().then();
function loadSportTerrains() {
    return __awaiter(this, void 0, void 0, function* () {
        for (const sportTerrain of (yield SportTerrainService.getList())) {
            const marker = new L.Marker([sportTerrain.latitude, sportTerrain.longitude], { icon: icon }).addTo(markers);
            marker.bindPopup(sportTerrain.type);
            marker.on('click', () => {
                onMarkerClick(Number(sportTerrain.id));
            });
            if (Number(sportTerrain.nb_events) > 0) {
                L.marker([sportTerrain.latitude, sportTerrain.longitude], {
                    icon: L.divIcon({
                        className: 'custom-icon',
                        html: `<div class=\"bg-danger text-center rounded-circle text-white border border-black border-2 fw-bold\">${sportTerrain.nb_events}</div>`,
                        iconAnchor: [-5, 50],
                        iconSize: [20, 20]
                    })
                }).addTo(numberMarkers);
            }
        }
    });
}
function loadCyclePaths() {
    return __awaiter(this, void 0, void 0, function* () {
        for (const cyclePath of (yield CyclePathService.getList())) {
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
            }).addTo(map);
        }
    });
}
function onMarkerClick(terrainId) {
    SportTerrainService.getById(terrainId).then((sportTerrain) => {
        const mapPanel = document.querySelector('[data-map-panel]');
        mapPanel.innerHTML = Template.getMapPanel(sportTerrain);
    });
}
