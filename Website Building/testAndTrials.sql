SELECT COUNT(*) FROM Δασικές_Πυρκαγιές WHERE όνομα_πυρ_σώματος='1' 
AND ημερομ_έναρξης='1' AND ώρα_έναρξης='1' AND ημερομ_κατασβ='1' 
AND ώρα_κατασβ='1' AND καμμένη_έκταση=1 AND πλήθος_προσωπικού=1 
AND πλήθος_οχημάτων=1 AND πλήθος_εναέριων_μέσων=1
        ;

truncate table fire_temp;
truncate table locations_temp;
truncate table meteo_temp;
truncate table stations_temp;
truncate table Δασικές_Πυρκαγιές cascade;
truncate table Δήμοι cascade;
truncate table Μ_Σταθμοί cascade;
truncate table Μ_Δεδομένα cascade;
truncate table ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ;
truncate table ΕΚΔΗΛΩΘΗΚΑΝ;
truncate table ΚΑΤΑΓΡΑΦΕΣ;

DELETE FROM Δασικές_Πυρκαγιές WHERE όνομα_πυρ_σώματος='$a1' AND ημερομ_έναρξης='$a2' AND ώρα_έναρξης='$a3' AND ημερομ_κατασβ='$a4' AND ώρα_κατασβ='$a5' AND καμμένη_έκταση=$a6 AND πλήθος_προσωπικού=$a7 AND πλήθος_οχημάτων=$a8 AND πλήθος_εναέριων_μέσων=$a9;
