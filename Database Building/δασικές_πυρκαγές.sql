CREATE TABLE Δασικές_Πυρκαγιές (id SERIAL,
    όνομα_πυρ_σώματος VARCHAR(150),
    ημερομ_έναρξης VARCHAR(20),
    ώρα_έναρξης VARCHAR(20),
    ημερομ_κατασβ VARCHAR(20),
    ώρα_κατασβ VARCHAR(20),
    καμμένη_έκταση FLOAT,
    πλήθος_προσωπικού INTEGER,
    πλήθος_οχημάτων INTEGER,
    πλήθος_εναέριων_μέσων INTEGER,
    PRIMARY KEY (id)
);

insert into Δασικές_Πυρκαγιές (όνομα_πυρ_σώματος, ημερομ_έναρξης, ώρα_έναρξης, ημερομ_κατασβ, ώρα_κατασβ, καμμένη_έκταση, πλήθος_προσωπικού, πλήθος_οχημάτων, πλήθος_εναέριων_μέσων)
select τμήμα, ημερομηνία_έναρξης, ώρα_έναρξης, ημερομηνία_κατάσβεσης, ώρα_κατάσβεσης, καμμένη_έκταση_στρ, προσωπικό, οχήματα, εναέρια
from fire_temp;