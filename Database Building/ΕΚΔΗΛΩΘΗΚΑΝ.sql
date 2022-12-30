CREATE TABLE IF NOT EXISTS ΕΚΔΗΛΩΘΗΚΑΝ (
    idΔΠ INTEGER,
    idΔήμοι INTEGER,
    FOREIGN KEY(idΔΠ) references Δασικές_Πυρκαγιές(id),
    FOREIGN KEY(idΔήμοι) references Δήμοι(id)
);


insert into ΕΚΔΗΛΩΘΗΚΑΝ (idΔΠ, idΔήμοι)
select distinct Δασικές_Πυρκαγιές.id, Δήμοι.id
from Δασικές_Πυρκαγιές, Δήμοι, fire_temp
WHERE fire_temp.δήμος = Δήμοι.όνομα_Δήμου 
AND Δασικές_Πυρκαγιές.όνομα_πυρ_σώματος = fire_temp.τμήμα
AND Δασικές_Πυρκαγιές.ημερομ_έναρξης = fire_temp.ημερομηνία_έναρξης
AND Δασικές_Πυρκαγιές.ώρα_έναρξης = fire_temp.ώρα_έναρξης
AND Δασικές_Πυρκαγιές.ημερομ_κατασβ = fire_temp.ημερομηνία_κατάσβεσης
AND Δασικές_Πυρκαγιές.ώρα_κατασβ = fire_temp.ώρα_κατάσβεσης
AND Δασικές_Πυρκαγιές.καμμένη_έκταση = fire_temp.καμμένη_έκταση_στρ
AND Δασικές_Πυρκαγιές.πλήθος_προσωπικού = fire_temp.προσωπικό
AND Δασικές_Πυρκαγιές.πλήθος_οχημάτων = fire_temp.οχήματα
AND Δασικές_Πυρκαγιές.πλήθος_εναέριων_μέσων = fire_temp.εναέρια;