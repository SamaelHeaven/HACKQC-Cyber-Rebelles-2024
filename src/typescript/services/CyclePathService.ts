import {CyclePath} from "../models/CyclePath.js";

export class CyclePathService {
    public static async getList(): Promise<CyclePath[]> {
        const response: Response = await fetch("/api/cycle-path-api.php?list=true");
        return response.json();
    }
}