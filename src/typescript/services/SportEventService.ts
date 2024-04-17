import {SportEvent} from "../models/SportEvent.js";

export class SportEventService {
    public static async getListBySportTerrainId(id: number): Promise<SportEvent[]> {
        let response: Response = await fetch("/src/php/api/event-api.php?terrainId=" + id);
        return await response.json();
    }
}