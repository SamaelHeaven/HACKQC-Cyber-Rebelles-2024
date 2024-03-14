SET
search_path TO public;

CREATE TABLE sport_terrain
(
    json_featuretype  TEXT,
    ID                INT,
    TYPE              TEXT,
    REVETEMENT_SOL    TEXT,
    MUNICIPALITE      TEXT,
    GEOM              TEXT,
    DATE_CREATION     DATE,
    DATE_MODIFICATION TIMESTAMP,
    LONGITUDE         NUMERIC,
    LATITUDE          NUMERIC,
    json_ogc_wkt_crs  TEXT,
    json_geometry     JSONB
);
