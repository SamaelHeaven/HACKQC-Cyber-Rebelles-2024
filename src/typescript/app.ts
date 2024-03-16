import {SportTerrainService} from "./SportTerrainService.js";
import {Template} from "./Template.js";
import {EventService} from "./EventService.js";

document.body.addEventListener('click', (event) => {
    let target = event.target as HTMLElement;
    handleNavLinkClick(target);
});

function handleNavLinkClick(target: HTMLElement) {
    let navLink = target.closest('[data-nav-link]') as HTMLElement;
    if (!navLink) {
        return;
    }
    let mapPanelSection = document.querySelector('[data-map-panel-section]') as HTMLElement;
    let terrainId = Number(mapPanelSection.dataset['mapPanelSection']);
    SportTerrainService.getById(terrainId).then(sportTerrain => {
        for (const element of Array.from(document.querySelectorAll('[data-nav-link]')) as HTMLElement[]) {
            element.classList.remove("active")
        }
        navLink.classList.add("active")
        if (navLink.dataset['navLink'] === "info") {
            mapPanelSection.innerHTML = Template.getInfoPanel(sportTerrain);
        }
        if (navLink.dataset['navLink'] === "events") {
            EventService.getListBySportTerrainId(terrainId).then(events => {
                mapPanelSection.innerHTML = Template.getEventsPanel(sportTerrain, events);
            })
        }
    });
}