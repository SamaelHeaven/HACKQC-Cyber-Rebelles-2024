import {Event} from "./Event.js";

export class EventService {
    public static async getListBySportTerrainId(id: number): Promise<Event[]> {
        let response = await fetch("/api/event-api.php?terrainId=" + id);
        return await response.json();
    }
}