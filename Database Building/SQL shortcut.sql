drop table fire_temp, locations_temp, meteo_temp, statons_temp;

CREATE TABLE IF NOT EXISTS fire_temp (
    τμήμα varchar(150),
    νομός varchar(150),
    δήμος varchar(150),
    ημερομηνία_έναρξης varchar(20),
    ώρα_έναρξης varchar(20),
    ημερομηνία_κατάσβεσης varchar (20),
    ώρα_κατάσβεσης varchar(20),
    καμμένη_έκταση_στρ float,
    προσωπικό integer,
    οχήματα integer,
    εναέρια integer
);

CREATE TABLE IF NOT EXISTS locations_temp (
    περιφέρεια varchar(150),
    νομός varchar(150),
    δήμος varchar(150),
    latitude float,
    longtitude float,
    station_of_reference varchar(150)
);

CREATE TABLE IF NOT EXISTS meteo_temp (
    station_name varchar(150),
    data_date varchar(20),
    avg_temp_C float,
    max_temp_C float,
    min_temp_C float,
    avg_hum_perc float,
    max_hum_perc float,
    min_hum_perc float,
    avg_atm_hPa float,
    max_atm_hPa float,
    min_atm_hPa float,
    rain_mm float,
    wind_speed_kmh float,
    wind_dir varchar(3),
    wind_gust_kmh float
);

CREATE TABLE IF NOT EXISTS stations_temp (
    station_name varchar(150),
    latitude float,
    longitude float,
    altitude float
);

\copy fire_temp FROM '/home/Data/2022-23/fire_data.csv' DELIMITER ';' csv header;

\copy locations_temp FROM '/home/Data/2022-23/locations_data.csv' DELIMITER ';' csv header;

\copy meteo_temp FROM '/home/Data/2022-23/meteo_data.csv' DELIMITER ';' csv header;

\copy stations_temp FROM '/home/Data/2022-23/stations_list.csv' DELIMITER ';' csv header;
