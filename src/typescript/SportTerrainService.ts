import {SportTerrain} from "./SportTerrain.js";

export class SportTerrainService {
    public static async getById(id: number): Promise<SportTerrain> {
        let response = await fetch("/api/sport-terrain-api.php?id=" + id);
        let result = await response.json();
        return result as SportTerrain;
    }
}