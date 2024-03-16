import {SportTerrainService} from "../services/SportTerrainService.js";
import {SportTerrain} from "../models/SportTerrain.js";
import {Template} from "../helpers/Template.js";
import {CyclePathService} from "../services/CyclePathService.js";

declare const L: any;

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

async function loadSportTerrains(): Promise<void> {
    for (const sportTerrain of (await SportTerrainService.getList())) {
        const marker = new L.Marker([sportTerrain.latitude, sportTerrain.longitude], {icon: icon}).addTo(markers);
        marker.bindPopup(sportTerrain.type);
        marker.on('click', (): void => {
            onMarkerClick(Number(sportTerrain.id))
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
}

async function loadCyclePaths(): Promise<void> {
    for (const cyclePath of (await CyclePathService.getList())) {
        const coordinates = JSON.parse(cyclePath.coordinates_json);
        const geoJsonFeature: object = {
            type: 'Feature',
            geometry: {
                type: cyclePath.type,
                coordinates: coordinates
            }
        };
        const geoJson = JSON.stringify(geoJsonFeature);
        L.geoJSON(JSON.parse(geoJson), {
            style: (): object => {
                return {
                    color: "green",
                    weight: 3
                };
            }
        }).addTo(map);
    }
}

function onMarkerClick(terrainId: number): void {
    SportTerrainService.getById(terrainId).then((sportTerrain: SportTerrain): void => {
        const mapPanel = document.querySelector('[data-map-panel]');
        mapPanel.innerHTML = Template.getMapPanel(sportTerrain);
    })
}