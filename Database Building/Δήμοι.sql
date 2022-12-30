CREATE TABLE IF NOT EXISTS Δήμοι (
    id SERIAL,
    όνομα_περιφέριας VARCHAR(150),
    όνομα_νομού VARCHAR(150),
    όνομα_Δήμου VARCHAR(150),
    γεωγ_πλάτος FLOAT,
    γεωγ_μήκος FLOAT,
    PRIMARY KEY (id)
);

insert into Δήμοι (όνομα_περιφέριας, όνομα_νομού, όνομα_Δήμου, γεωγ_πλάτος, γεωγ_μήκος)
select περιφέρεια, νομός, δήμος, latitude, longtitude
from locations_temp;