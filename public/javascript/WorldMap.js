import { Template } from "./Template.js";
import { SportTerrainService } from "./SportTerrainService.js";
export class WorldMap {
    static onMarkerClick(terrainId) {
        SportTerrainService.getById(terrainId).then(sportTerrain => {
            let mapPanel = document.querySelector('[data-map-panel]');
            mapPanel.innerHTML = Template.getMapPanel(sportTerrain);
        });
    }
}
