CREATE TABLE ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ 	(idΜΣ INTEGER,
	idΔήμοι INTEGER,
	FOREIGN KEY(idΜΣ) references Μ_Σταθμοί(id),
	FOREIGN KEY(idΔήμοι) references Δήμοι(id)
);