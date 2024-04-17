import {SportEvent} from "../models/SportEvent.js";

export class SportEventService {
    public static async getListBySportTerrainId(id: number): Promise<SportEvent[]> {
        let response: Response = await fetch("/api/event-api.php?terrainId=" + id);
        return response.json();
    }
}