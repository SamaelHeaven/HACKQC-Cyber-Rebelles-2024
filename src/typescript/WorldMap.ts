import {Template} from "./Template.js";
import {SportTerrainService} from "./SportTerrainService.js";
import {SportTerrain} from "./SportTerrain";

export class WorldMap {
    public static onMarkerClick(terrainId: number): void {
        SportTerrainService.getById(terrainId).then((sportTerrain: SportTerrain) => {
            const mapPanel = document.querySelector('[data-map-panel]');
            mapPanel.innerHTML = Template.getMapPanel(sportTerrain);
        })
    }
}