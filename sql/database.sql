SET
search_path TO public;

CREATE TABLE sport_terrain
(
    id                INT PRIMARY KEY,
    json_featuretype  TEXT,
    type              TEXT,
    revetement_sol    TEXT,
    municipalite      TEXT,
    geom              TEXT,
    date_creation     DATE,
    date_modification TIMESTAMP,
    longitude         NUMERIC,
    latitude          NUMERIC,
    json_ogc_wkt_crs  TEXT,
    json_geometry     JSONB
);

CREATE TABLE event
(
    id               SERIAL PRIMARY KEY,
    sport_terrain_id INT,
    organizer        VARCHAR,
    eventName        VARCHAR,
    description      VARCHAR,
    dateStart        DATE,
    dateEnd          DATE,
    timeStart        TIME,
    timeEnd          TIME
);
