CREATE TABLE Δασικές_Πυρκαγιές (id INTEGER,
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