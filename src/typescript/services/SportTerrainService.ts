import {SportTerrain} from "../models/SportTerrain.js";

export class SportTerrainService {
    public static async getById(id: number): Promise<SportTerrain> {
        const response: Response = await fetch("/api/sport-terrain-api.php?id=" + id);
        return await response.json();
    }

    public static async getList(): Promise<SportTerrain[]> {
        const response: Response = await fetch("/api/sport-terrain-api.php?list=true");
        return await response.json();
    }
}