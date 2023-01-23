-- 1

SELECT  όνομα_περιφέριας, όνομα_νομού, όνομα_Δήμου, γεωγ_πλάτος, γεωγ_μήκος  
FROM    Δήμοι
GROUP BY    όνομα_περιφέριας, όνομα_νομού, όνομα_Δήμου, γεωγ_πλάτος, γεωγ_μήκος
ORDER BY    όνομα_περιφέριας ASC, όνομα_νομού ASC, όνομα_Δήμου ASC;   

-- 2

SELECT  Μ_Σταθμοί.όνομα_μετεωρ_σταθμού, MAX(Μ_Δεδομένα.μέγιστη_θερμοκρασία), MIN(Μ_Δεδομένα.ελάχιστη_θερμοκρασία),
    MAX(Μ_Δεδομένα.μέγιστη_υγρασία), MIN(Μ_Δεδομένα.ελάχιστη_υγρασία), MAX(Μ_Δεδομένα.ημερήσια_βροχόπτωση),
    MAX(Μ_Δεδομένα.μέση_ταχύτητα_ανέμου), MAX(Μ_Δεδομένα.μέγιστη_ριπή_ανέμου)
FROM    Μ_Σταθμοί, Μ_Δεδομένα, ΚΑΤΑΓΡΑΦΕΣ
WHERE   ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
GROUP BY    όνομα_μετεωρ_σταθμού
ORDER BY    όνομα_μετεωρ_σταθμού ASC;

-- 3

SELECT  Δασικές_Πυρκαγιές.*
FROM    Δασικές_Πυρκαγιές, Δήμοι, ΕΚΔΗΛΩΘΗΚΑΝ
WHERE   ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ = Δασικές_Πυρκαγιές.id
AND     ΕΚΔΗΛΩΘΗΚΑΝ.idΔήμοι = Δήμοι.id
AND     Δήμοι.όνομα_Δήμου = 'ΩΡΩΠΟΥ'
ORDER BY    Δασικές_Πυρκαγιές.καμμένη_έκταση DESC;

-- 4

SELECT  Δήμοι.όνομα_περιφέριας, COUNT(Δασικές_Πυρκαγιές.καμμένη_έκταση) as Συνολικός_αριθμός_καμμένων_δασικών_εκτάσεων
FROM    Δήμοι, Δασικές_Πυρκαγιές, ΕΚΔΗΛΩΘΗΚΑΝ
WHERE   ΕΚΔΗΛΩΘΗΚΑΝ.idΔήμοι = Δήμοι.id
AND     ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ = Δασικές_Πυρκαγιές.id
GROUP BY Δήμοι.όνομα_περιφέριας
ORDER BY SUM(Δασικές_Πυρκαγιές.καμμένη_έκταση) DESC;

-- 5

SELECT DISTINCT όνομα_μετεωρ_σταθμού
FROM   Μ_Σταθμοί, Μ_Δεδομένα, ΚΑΤΑΓΡΑΦΕΣ
WHERE  ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
AND    ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id 
AND    Μ_Δεδομένα.ημερομηνία = '2010-01-01'
AND (Μ_Δεδομένα.μέση_θερμοκρασία IS NULL
OR Μ_Δεδομένα.μέγιστη_θερμοκρασία IS NULL 
OR Μ_Δεδομένα.ελάχιστη_θερμοκρασία IS NULL 
OR Μ_Δεδομένα.μέση_υγρασία IS NULL 
OR Μ_Δεδομένα.μέγιστη_υγρασία IS NULL
OR Μ_Δεδομένα.ελάχιστη_υγρασία IS NULL 
OR Μ_Δεδομένα.μέση_ατμοσφ_πίεση IS NULL
OR Μ_Δεδομένα.μέγιστη_ατμοσφ_πίεση IS NULL 
OR Μ_Δεδομένα.ελάχιστη_ατμοσφ_πίεση IS NULL
OR Μ_Δεδομένα.ημερήσια_βροχόπτωση IS NULL
OR Μ_Δεδομένα.μέση_ταχύτητα_ανέμου IS NULL
OR Μ_Δεδομένα.διευθ_ανέμου IS NULL
OR Μ_Δεδομένα.μέγιστη_ριπή_ανέμου IS NULL); 

-- 6

SELECT Δήμοι.όνομα_περιφέριας, Δήμοι.όνομα_νομού, Δήμοι.όνομα_Δήμου, COUNT(ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ), SUM(Δασικές_Πυρκαγιές.καμμένη_έκταση)
FROM Δήμοι, ΕΚΔΗΛΩΘΗΚΑΝ, Δασικές_Πυρκαγιές
WHERE   ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ = Δασικές_Πυρκαγιές.id
AND     ΕΚΔΗΛΩΘΗΚΑΝ.idΔήμοι = Δήμοι.id
GROUP BY Δήμοι.όνομα_περιφέριας, Δήμοι.όνομα_νομού, Δήμοι.όνομα_Δήμου
ORDER BY COUNT(ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ) DESC
LIMIT 1;

-- 7

SELECT  Δήμοι.όνομα_νομού, SUM(Δασικές_Πυρκαγιές.πλήθος_εναέριων_μέσων)
FROM    Δήμοι, Δασικές_Πυρκαγιές, ΕΚΔΗΛΩΘΗΚΑΝ
WHERE   ΕΚΔΗΛΩΘΗΚΑΝ.idΔήμοι = Δήμοι.id
AND     ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ = Δασικές_Πυρκαγιές.id
AND     Δασικές_Πυρκαγιές.πλήθος_εναέριων_μέσων > 30
AND     Δασικές_Πυρκαγιές.ημερομ_έναρξης >= '2021-06-01'
AND     Δασικές_Πυρκαγιές.ημερομ_έναρξης <= '2021-08-31'
GROUP BY    Δήμοι.όνομα_νομού;

-- 8

SELECT  Μ_Σταθμοί.όνομα_μετεωρ_σταθμού, Μ_Δεδομένα.ημερομηνία, Μ_Δεδομένα.μέγιστη_θερμοκρασία, Μ_Δεδομένα.μέση_υγρασία, Μ_Δεδομένα.μέγιστη_ριπή_ανέμου
FROM    Μ_Σταθμοί, Μ_Δεδομένα, ΚΑΤΑΓΡΑΦΕΣ
WHERE   ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
AND     Μ_Δεδομένα.μέγιστη_θερμοκρασία >= 10
AND     Μ_Δεδομένα.μέση_υγρασία < 60
AND     Μ_Δεδομένα.μέγιστη_ριπή_ανέμου > 2
ORDER BY   Μ_Σταθμοί.όνομα_μετεωρ_σταθμού ASC;

-- 9

SELECT  Μ_Δεδομένα.*
FROM    Μ_Δεδομένα, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ   
WHERE   Μ_Σταθμοί.όνομα_μετεωρ_σταθμού = 'aghiosnikolaos'
AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
AND     Μ_Δεδομένα.ημερομηνία >= '2010-06-01'
AND     Μ_Δεδομένα.ημερομηνία <= '2010-09-01'
EXCEPT  
SELECT  Μ_Δεδομένα.*
FROM    Μ_Δεδομένα, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ   
WHERE   Μ_Σταθμοί.όνομα_μετεωρ_σταθμού = 'aghiosnikolaos'
AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
AND     Μ_Δεδομένα.ημερομηνία >= '2010-08-01'
AND     Μ_Δεδομένα.ημερομηνία <= '2010-08-02';

-- 10

SELECT Δήμοι.όνομα_Δήμου, Μ_Δεδομένα.μέση_θερμοκρασία, Μ_Δεδομένα.μέση_υγρασία, Μ_Δεδομένα.μέση_ταχύτητα_ανέμου, Μ_Δεδομένα.διευθ_ανέμου 
FROM   Δήμοι, Μ_Δεδομένα, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ, ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ
WHERE  Δήμοι.όνομα_περιφέριας = 'ΠΕΡΙΦΈΡΕΙΑ ΑΤΤΙΚΉΣ' 
AND    ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΔήμοι = Δήμοι.id
AND    ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΜΣ = Μ_Σταθμοί.id
AND    ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
AND    ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
AND    Μ_Δεδομένα.ημερομηνία = '2010-08-02'
GROUP BY Δήμοι.όνομα_Δήμου, Μ_Δεδομένα.μέση_θερμοκρασία, Μ_Δεδομένα.μέση_υγρασία, Μ_Δεδομένα.μέση_ταχύτητα_ανέμου, Μ_Δεδομένα.διευθ_ανέμου;

-- 11

SELECT  Δήμοι.όνομα_περιφέριας, Δήμοι.όνομα_νομού, AVG(Μ_Δεδομένα.μέση_υγρασία)
    FROM    Δήμοι, ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ, Μ_Δεδομένα
    WHERE   ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΔήμοι = Δήμοι.id
    AND     ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΜΣ = Μ_Σταθμοί.id
    AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
    AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
    GROUP BY Δήμοι.όνομα_περιφέριας, Δήμοι.όνομα_νομού
    ORDER BY AVG(Μ_Δεδομένα.μέση_υγρασία) DESC
    LIMIT   5;

-- 12

SELECT  Δασικές_Πυρκαγιές.*  
FROM    Δασικές_Πυρκαγιές, Δήμοι, ΕΚΔΗΛΩΘΗΚΑΝ
WHERE   ΕΚΔΗΛΩΘΗΚΑΝ.idΔήμοι = Δήμοι.id
AND     ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ = Δασικές_Πυρκαγιές.id
AND     Δήμοι.γεωγ_πλάτος = 38.2456157
AND     Δήμοι.γεωγ_μήκος = 23.771523292513955
ORDER BY Δασικές_Πυρκαγιές.καμμένη_έκταση DESC;

-- 13

SELECT  DISTINCT Δήμοι.όνομα_περιφέριας 
    FROM    Δήμοι, ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ, Μ_Δεδομένα
    WHERE   ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΔήμοι = Δήμοι.id
    AND     ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΜΣ = Μ_Σταθμοί.id
    AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
    AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
    AND     ((Μ_Δεδομένα.μέγιστη_θερμοκρασία > 15
    AND     Μ_Δεδομένα.μέγιστη_θερμοκρασία < 30)
    OR      (Μ_Δεδομένα.ελάχιστη_θερμοκρασία > 15
    AND     Μ_Δεδομένα.ελάχιστη_θερμοκρασία < 30)
    OR      (Μ_Δεδομένα.μέση_θερμοκρασία > 15
    AND     Μ_Δεδομένα.μέση_θερμοκρασία < 30));

-- 14 -- not done

SELECT  Δασικές_Πυρκαγιές.ημερομ_έναρξης, Δασικές_Πυρκαγιές.ώρα_έναρξης, 
        Δήμοι.όνομα_νομού, Δήμοι.όνομα_Δήμου, Δασικές_Πυρκαγιές.καμμένη_έκταση, 
        Μ_Δεδομένα.μέγιστη_θερμοκρασία, Μ_Δεδομένα.μέση_υγρασία, Μ_Δεδομένα.μέγιστη_ριπή_ανέμου
FROM    Δασικές_Πυρκαγιές, ΕΚΔΗΛΩΘΗΚΑΝ, Δήμοι, ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ, Μ_Δεδομένα
WHERE   ΕΚΔΗΛΩΘΗΚΑΝ.idΔήμοι = Δήμοι.id
AND     ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ = Δασικές_Πυρκαγιές.id
AND     ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΔήμοι = Δήμοι.id
AND     ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΜΣ = Μ_Σταθμοί.id
AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
AND     Δασικές_Πυρκαγιές.ημερομ_έναρξης <= '2014-12-31'
GROUP BY Δασικές_Πυρκαγιές.ημερομ_έναρξης, Δασικές_Πυρκαγιές.ώρα_έναρξης, 
        Δήμοι.όνομα_νομού, Δήμοι.όνομα_Δήμου, Δασικές_Πυρκαγιές.καμμένη_έκταση, 
        Μ_Δεδομένα.μέγιστη_θερμοκρασία, Μ_Δεδομένα.μέση_υγρασία, Μ_Δεδομένα.μέγιστη_ριπή_ανέμου
ORDER BY Δασικές_Πυρκαγιές.καμμένη_έκταση DESC
LIMIT   6;

-- 15 -- not done

SELECT DISTINCT (Δήμοι.όνομα_νομού), AVG(Μ_Δεδομένα.μέση_θερμοκρασία), Μ_Δεδομένα.ελάχιστη_θερμοκρασία, Μ_Δεδομένα.μέγιστη_θερμοκρασία
FROM    Δήμοι, ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ, Μ_Δεδομένα
WHERE   ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΔήμοι = Δήμοι.id
AND     ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΜΣ = Μ_Σταθμοί.id
AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
AND     Μ_Δεδομένα.μέση_θερμοκρασία IS NOT NULL
group by Δήμοι.όνομα_νομού, Μ_Δεδομένα.ελάχιστη_θερμοκρασία, Μ_Δεδομένα.μέγιστη_θερμοκρασία
order by Δήμοι.όνομα_νομού, AVG(Μ_Δεδομένα.μέση_θερμοκρασία), Μ_Δεδομένα.ελάχιστη_θερμοκρασία, Μ_Δεδομένα.μέγιστη_θερμοκρασία;