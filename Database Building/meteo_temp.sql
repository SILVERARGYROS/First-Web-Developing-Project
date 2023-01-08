CREATE TABLE IF NOT EXISTS meteo_temp (
    station_name varchar(150),
    date date,
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
    wind_dir varchar(20),
    wind_gust_kmh float
);

INSERT INTO meteo_temp VALUES ('aghiosnikolaos',2010-11-23,21.6,23.5,19.4,58.4,71,46,1009.1,1010.3,1008.1,0.0,24.6,'S',70.8);

\copy meteo_temp FROM '/home/Data/2022-23/meteo_data.csv' DELIMITER ';' csv header NULL AS 'NULL';