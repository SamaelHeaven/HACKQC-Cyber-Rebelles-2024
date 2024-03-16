export interface Event {
    id: string;
    sport_terrain_id: string;
    organizer: string;
    event_name: string;
    description: string;
    start_date: Date;
    end_date: Date;
    start_time: string;
    end_time: string;
}