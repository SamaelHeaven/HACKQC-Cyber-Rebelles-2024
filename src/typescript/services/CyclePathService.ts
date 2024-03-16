import {CyclePath} from "../models/CyclePath.js";

export class CyclePathService {
    public static async getList(): Promise<CyclePath[]> {
        const response: Response = await fetch("/src/php/api/cycle-path-api.php?list=true");
        return await response.json();
    }
}