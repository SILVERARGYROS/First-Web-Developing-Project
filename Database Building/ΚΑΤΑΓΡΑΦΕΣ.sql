CREATE TABLE IF NOT EXISTS ΚΑΤΑΓΡΑΦΕΣ (
	idΜΣ INTEGER,
	idΜΔ INTEGER,
	FOREIGN KEY(idΜΣ) references Μ_Σταθμοί(id),
	FOREIGN KEY(idΜΔ) references Μ_Δεδομένα(id)
);
insert into ΚΑΤΑΓΡΑΦΕΣ (idΜΣ, idΜΔ)
select distinct Μ_Σταθμοί.id, Μ_Δεδομένα.id
from Μ_Σταθμοί, Μ_Δεδομένα, meteo_temp
WHERE Μ_Σταθμοί.όνομα_μετεωρ_σταθμού = meteo_temp.station_name 
AND (Μ_Δεδομένα.ημερομηνία = meteo_temp.date OR (Μ_Δεδομένα.ημερομηνία IS NULL AND meteo_temp.date IS NULL))
AND (Μ_Δεδομένα.μέση_θερμοκρασία = meteo_temp.avg_temp_C OR (Μ_Δεδομένα.μέση_θερμοκρασία IS NULL AND meteo_temp.avg_temp_C IS NULL))
AND (Μ_Δεδομένα.μέγιστη_θερμοκρασία = meteo_temp.max_temp_C OR (Μ_Δεδομένα.μέγιστη_θερμοκρασία IS NULL AND meteo_temp.max_temp_C IS NULL))
AND (Μ_Δεδομένα.ελάχιστη_θερμοκρασία = meteo_temp.min_temp_C OR (Μ_Δεδομένα.ελάχιστη_θερμοκρασία IS NULL AND meteo_temp.min_temp_C IS NULL))
AND (Μ_Δεδομένα.μέση_υγρασία = meteo_temp.avg_hum_perc OR (Μ_Δεδομένα.μέση_υγρασία IS NULL AND meteo_temp.avg_hum_perc IS NULL))
AND (Μ_Δεδομένα.μέγιστη_υγρασία = meteo_temp.max_hum_perc OR (Μ_Δεδομένα.μέγιστη_υγρασία IS NULL AND meteo_temp.max_hum_perc IS NULL))
AND (Μ_Δεδομένα.ελάχιστη_υγρασία = meteo_temp.min_hum_perc OR (Μ_Δεδομένα.ελάχιστη_υγρασία IS NULL AND meteo_temp.min_hum_perc IS NULL))
AND (Μ_Δεδομένα.μέση_ατμοσφ_πίεση = meteo_temp.avg_atm_hPa OR (Μ_Δεδομένα.μέση_ατμοσφ_πίεση IS NULL AND meteo_temp.avg_atm_hPa IS NULL))
AND (Μ_Δεδομένα.μέγιστη_ατμοσφ_πίεση = meteo_temp.max_atm_hPa OR (Μ_Δεδομένα.μέγιστη_ατμοσφ_πίεση IS NULL AND meteo_temp.max_atm_hPa IS NULL))
AND (Μ_Δεδομένα.ελάχιστη_ατμοσφ_πίεση = meteo_temp.min_atm_hPa OR (Μ_Δεδομένα.ελάχιστη_ατμοσφ_πίεση IS NULL AND meteo_temp.min_atm_hPa IS NULL))
AND (Μ_Δεδομένα.ημερήσια_βροχόπτωση = meteo_temp.rain_mm OR (Μ_Δεδομένα.ημερήσια_βροχόπτωση IS NULL AND meteo_temp.rain_mm IS NULL))
AND (Μ_Δεδομένα.μέση_ταχύτητα_ανέμου = meteo_temp.wind_speed_kmh OR (Μ_Δεδομένα.μέση_ταχύτητα_ανέμου IS NULL AND meteo_temp.wind_speed_kmh IS NULL))
AND (Μ_Δεδομένα.διευθ_ανέμου = meteo_temp.wind_dir OR (Μ_Δεδομένα.διευθ_ανέμου IS NULL AND meteo_temp.wind_dir IS NULL))
AND (Μ_Δεδομένα.μέγιστη_ριπή_ανέμου = meteo_temp.wind_gust_kmh OR (Μ_Δεδομένα.μέγιστη_ριπή_ανέμου IS NULL AND meteo_temp.wind_gust_kmh IS NULL));