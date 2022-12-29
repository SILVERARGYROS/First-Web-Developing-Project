CREATE TABLE IF NOT EXISTS stations_temp (
    station_name varchar(100),
    latitude float,
    longitude float,
    altitude float
);

INSERT INTO stations_temp VALUES ('aghiosnikolaos',35.191400,25.720900,30.0);

\copy stations_temp FROM '/home/Data/2022-23/stations_list.csv' DELIMITER ';' csv header;
