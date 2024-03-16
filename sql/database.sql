SET
search_path TO public;

CREATE TABLE sport_terrain
(
    id                SERIAL PRIMARY KEY,
    terrain           TEXT,
    type              TEXT,
    flooring          TEXT,
    city              TEXT,
    address           VARCHAR,
    creation_date     DATE,
    modification_date TIMESTAMP,
    longitude         NUMERIC,
    latitude          NUMERIC
);

CREATE TABLE event
(
    id               SERIAL PRIMARY KEY,
    sport_terrain_id INT,
    organizer        VARCHAR,
    event_name       VARCHAR,
    description      VARCHAR,
    start_date       DATE,
    end_date         DATE,
    start_time       TIME,
    end_time         TIME
);

CREATE TABLE cycle_path
(
    id               SERIAL PRIMARY KEY,
    type             VARCHAR,
    coordinates_json VARCHAR
);
