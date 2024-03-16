import {SportTerrain} from "./SportTerrain.js";

export class SportTerrainService {
    public static async getById(id: number): Promise<SportTerrain> {
        const response: Response = await fetch("/src/php/api/sport-terrain-api.php?id=" + id);
        return await response.json();
    }
}