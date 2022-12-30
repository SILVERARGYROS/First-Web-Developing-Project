CREATE TABLE IF NOT EXISTS Μ_Δεδομένα (
    id SERIAL,
    ημερομηνία VARCHAR(20),
    μέση_θερμοκρασία FLOAT,
    μέγιστη_θερμοκρασία FLOAT,
    ελάχιστη_θερμοκρασία FLOAT,
    μέση_υγρασία FLOAT,
    μέγιστη_υγρασία FLOAT,
    ελάχιστη_υγρασία FLOAT,
    μέση_ατμοσφ_πίεση FLOAT,
    μέγιστη_ατμοσφ_πίεση FLOAT,
    ελάχιστη_ατμοσφ_πίεση FLOAT,
    ημερήσια_βροχόπτωση FLOAT,
    μέση_ταχύτητα_ανέμου FLOAT,
    διευθ_ανέμου VARCHAR(3),
    μέγιστη_ριπή_ανέμου FLOAT,
    PRIMARY KEY (id)
);

insert into Μ_Δεδομένα (ημερομηνία, μέση_θερμοκρασία, μέγιστη_θερμοκρασία, ελάχιστη_θερμοκρασία, μέση_υγρασία, μέγιστη_υγρασία, ελάχιστη_υγρασία, μέση_ατμοσφ_πίεση, μέγιστη_ατμοσφ_πίεση, ελάχιστη_ατμοσφ_πίεση, ημερήσια_βροχόπτωση, μέση_ταχύτητα_ανέμου, διευθ_ανέμου, μέγιστη_ριπή_ανέμου)
select date, avg_temp_C, max_temp_C, min_temp_C, avg_hum_perc, max_hum_perc, min_hum_perc, avg_atm_hPa, max_atm_hPa, min_atm_hPa, rain_mm, wind_speed_kmh, wind_dir, wind_gust_kmh
from meteo_temp;