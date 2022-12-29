CREATE TABLE IF NOT EXISTS locations_temp (
    περιφέρεια varchar(150),
    νομός varchar(150),
    δήμος varchar(150),
    latitude float,
    longtitude float,
    station_of_reference varchar(150)
);

INSERT INTO locations_temp VALUES ('ΠΕΡΙΦΈΡΕΙΑ ΑΤΤΙΚΉΣ','ΑΤΤΙΚΗΣ','ΩΡΩΠΟΥ',38.2456157,23.771523292513955,'tanagra');

\copy locations_temp FROM '/home/Data/2022-23/locations_data.csv' DELIMITER ';' csv header;