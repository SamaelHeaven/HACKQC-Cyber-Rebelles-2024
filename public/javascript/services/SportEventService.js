export class SportEventService {
    static async getListBySportTerrainId(id) {
        let response = await fetch("/api/event-api.php?terrainId=" + id);
        return await response.json();
    }
}
