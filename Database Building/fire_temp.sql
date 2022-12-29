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

INSERT INTO fire_temp VALUES ('6ος Π.Σ. ΑΘΗΝΩΝ','ΑΤΤΙΚΗΣ','ΔΙΟΝΥΣΟΥ','6/24/2013','15:42','6/24/2013','21:10',5.0,13,13,1);

\copy fire_temp FROM '/home/Data/2022-23/fire_data.csv' DELIMITER ';' csv header;
