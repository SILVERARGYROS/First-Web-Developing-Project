CREATE TABLE ΕΚΔΗΛΩΘΗΚΑΝ 	(idΔΠ INTEGER,
    idΔήμοι INTEGER,
    FOREIGN KEY(idΔΠ) references Δασικές_Πυρκαγιές(id),
    FOREIGN KEY(idΔήμοι) references Δήμοι(id)
);

