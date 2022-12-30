CREATE TABLE IF NOT EXISTS Μ_Σταθμοί (
    id SERIAL,
    όνομα_μετεωρ_σταθμού VARCHAR(150),
    γεωγ_πλάτος	FLOAT,
    γεωγ_μήκος FLOAT,
    υψόμετρο FLOAT,
    PRIMARY KEY (id)
);

insert into Μ_Σταθμοί (όνομα_μετεωρ_σταθμού, γεωγ_πλάτος, γεωγ_μήκος, υψόμετρο)
select station_name, latitude, longitude, altitude
from stations_temp;