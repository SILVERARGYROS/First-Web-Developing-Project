CREATE TABLE IF NOT EXISTS ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ (
	idΜΣ INTEGER,
	idΔήμοι INTEGER,
	FOREIGN KEY(idΜΣ) references Μ_Σταθμοί(id),
	FOREIGN KEY(idΔήμοι) references Δήμοι(id)
);

insert into ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ (idΜΣ, idΔήμοι)
select distinct Μ_Σταθμοί.id, Δήμοι.id
from locations_temp, Δήμοι, Μ_Σταθμοί
WHERE locations_temp.δήμος = Δήμοι.όνομα_Δήμου
AND locations_temp.station_of_reference = Μ_Σταθμοί.όνομα_μετεωρ_σταθμού;