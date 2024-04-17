export class CyclePathService {
    static async getList() {
        const response = await fetch("/api/cycle-path-api.php?list=true");
        return await response.json();
    }
}
