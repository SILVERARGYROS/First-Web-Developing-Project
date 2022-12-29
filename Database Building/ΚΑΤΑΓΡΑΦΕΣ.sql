CREATE TABLE ΚΑΤΑΓΡΑΦΕΣ (idΜΣ INTEGER,
	idΜΔ INTEGER,
	FOREIGN KEY(idΜΣ) references Μ_Σταθμοί(id),
	FOREIGN KEY(idΜΔ) references Μ_Δεδομένα(id)
);