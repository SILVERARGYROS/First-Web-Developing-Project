CREATE TABLE ΚΑΤΑΓΡΑΦΕΣ (
	idΜΣ INTEGER,
	idΜΔ INTEGER,
	FOREIGN KEY(idΜΣ) references Μ_Σταθμοί(id),
	FOREIGN KEY(idΜΔ) references Μ_Δεδομένα(id)
);

insert into ΚΑΤΑΓΡΑΦΕΣ (idΜΣ, idΜΔ)
select distinct Μ_Σταθμοί.id, Μ_Δεδομένα.id
from Μ_Σταθμοί, Μ_Δεδομένα, meteo_temp
WHERE Μ_Σταθμοί.όνομα_μετεωρ_σταθμού = meteo_temp.station_name
AND Μ_Δεδομένα.ημερομηνία = meteo_temp.date
AND Μ_Δεδομένα.μέση_θερμοκρασία = meteo_temp.avg_temp_C
AND Μ_Δεδομένα.μέγιστη_θερμοκρασία = meteo_temp.max_temp_C
AND Μ_Δεδομένα.ελάχιστη_θερμοκρασία = meteo_temp.min_temp_C
AND Μ_Δεδομένα.μέση_υγρασία = meteo_temp.avg_hum_perc
AND Μ_Δεδομένα.μέγιστη_υγρασία = meteo_temp.max_hum_perc
AND Μ_Δεδομένα.ελάχιστη_υγρασία = meteo_temp.min_hum_perc
AND Μ_Δεδομένα.μέση_ατμοσφ_πίεση = meteo_temp.avg_atm_hPa
AND Μ_Δεδομένα.μέγιστη_ατμοσφ_πίεση = meteo_temp.max_atm_hPa
AND Μ_Δεδομένα.ελάχιστη_ατμοσφ_πίεση = meteo_temp.min_atm_hPa
AND Μ_Δεδομένα.ημερήσια_βροχόπτωση = meteo_temp.rain_mm
AND Μ_Δεδομένα.μέση_ταχύτητα_ανέμου = meteo_temp.wind_speed_kmh
AND Μ_Δεδομένα.διευθ_ανέμου = meteo_temp.wind_dir
AND Μ_Δεδομένα.μέγιστη_ριπή_ανέμου = meteo_temp.wind_gust_kmh;