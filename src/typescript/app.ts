import {SportTerrainService} from "./SportTerrainService.js";
import {Template} from "./Template.js";
import {EventService} from "./EventService.js";
import {SportTerrain} from "./SportTerrain";
import {Event} from "./Event";

document.body.addEventListener('click', (event: MouseEvent): void => {
    const target: HTMLElement = event.target as HTMLElement;
    handleNavLinkClick(target);
});

function handleNavLinkClick(target: HTMLElement): void {
    const navLink: HTMLElement = target.closest('[data-nav-link]') as HTMLElement;
    if (!navLink) {
        return;
    }
    const mapPanelSection: HTMLElement = document.querySelector('[data-map-panel-section]') as HTMLElement;
    const terrainId: number = Number(mapPanelSection.dataset['mapPanelSection']);
    SportTerrainService.getById(terrainId).then((sportTerrain: SportTerrain): void => {
        for (const element of Array.from(document.querySelectorAll('[data-nav-link]')) as HTMLElement[]) {
            element.classList.remove("active")
        }
        navLink.classList.add("active")
        if (navLink.dataset['navLink'] === "info") {
            mapPanelSection.innerHTML = Template.getInfoPanel(sportTerrain);
        }
        if (navLink.dataset['navLink'] === "events") {
            EventService.getListBySportTerrainId(terrainId).then((events: Event[]): void => {
                mapPanelSection.innerHTML = Template.getEventsPanel(sportTerrain, events);
            })
        }
    });
}