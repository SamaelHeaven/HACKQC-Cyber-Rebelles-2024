export class SportTerrainService {
    static async getById(id) {
        const response = await fetch("/src/php/api/sport-terrain-api.php?id=" + id);
        return await response.json();
    }
    static async getList() {
        const response = await fetch("/src/php/api/sport-terrain-api.php?list=true");
        return await response.json();
    }
}
