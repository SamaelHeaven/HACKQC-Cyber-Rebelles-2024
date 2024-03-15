import {SportTerrain} from "./SportTerrain.js";

export class SportTerrainService {
    public static async getById(id: number): Promise<SportTerrain> {
        let response = await fetch("/api/sport-terrain-api.php?id=" + id);
        return await response.json();
    }
}