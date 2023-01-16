<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Rebuild Database Page</title>
    </head>

    <body>
        <?php include 'login.php'?>
        <!--Topbar Navigation Code-->
        <div class="topnav">
            <a class="button" href="index.php">db1u10</a>
            <div class="topnav-right">
                <a href="viewnav.php">Προβολή</a>
                <a href="addnav.php">Προσθήκη Εγγραφής</a>
                <a href="addfilenav.php">Προσθήκη Αρχείου</a>
                <a href="delnav.php">Διαγραφή Εγγραφής</a>
                <a href="settings.php">Ρυθμίσεις</a>
            </div>
        </div>
        <!--Topbar Navigation Code-->

        <h3>Ανοικοδόμιση Βάσης</h3>
        
        <h1>
            Διαγραφή και ανοικοδόμιση βάσης.<br>
            <br>
            <p style='color: red'>
            ΠΡΟΣΟΧΗ: Αυτό θα σβήσει όλα τα δεδομένα μέσα στη βάση και θα επαναφέρει τις ακολουθίες αρίθμησης.<br>
                <br>
                Είστε σίγουροι ότι θέλετε να συνεχίσετε;
            </p>
        </h1>
        <p style='color: red'>
            <form action="<?php $_PHP_SELF ?>" method = "GET"><input class="block" type="submit" value="ΑΝΟΙΚΟΔΟΜΙΣΗ ΒΑΣΗΣ" name="submit"></input>

            <?php
                if(isset($_GET["submit"]))
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                        or die ("Αποτυχία Σύνδεσης!");

                    $query = "drop table if exists fire_temp;
                    drop table if exists locations_temp;
                    drop table if exists meteo_temp;
                    drop table if exists stations_temp;
                    drop table if exists Δασικές_Πυρκαγιές cascade;
                    drop table if exists Δήμοι cascade;
                    drop table if exists Μ_Σταθμοί cascade;
                    drop table if exists Μ_Δεδομένα cascade;
                    drop table if exists ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ;
                    drop table if exists ΕΚΔΗΛΩΘΗΚΑΝ;
                    drop table if exists ΚΑΤΑΓΡΑΦΕΣ;
                    
                    CREATE TABLE IF NOT EXISTS Δασικές_Πυρκαγιές (
                        id SERIAL,
                        όνομα_πυρ_σώματος VARCHAR(150),
                        ημερομ_έναρξης date,
                        ώρα_έναρξης time,
                        ημερομ_κατασβ date,
                        ώρα_κατασβ time,
                        καμμένη_έκταση FLOAT,
                        πλήθος_προσωπικού INTEGER,
                        πλήθος_οχημάτων INTEGER,
                        πλήθος_εναέριων_μέσων INTEGER,
                        PRIMARY KEY (id)
                    );
                    
                    CREATE TABLE IF NOT EXISTS Δήμοι (
                        id SERIAL,
                        όνομα_περιφέριας VARCHAR(150),
                        όνομα_νομού VARCHAR(150),
                        όνομα_Δήμου VARCHAR(150),
                        γεωγ_πλάτος FLOAT,
                        γεωγ_μήκος FLOAT,
                        PRIMARY KEY (id)
                    );
                    
                    
                    CREATE TABLE IF NOT EXISTS Μ_Σταθμοί (
                        id SERIAL,
                        όνομα_μετεωρ_σταθμού VARCHAR(150),
                        γεωγ_πλάτος	FLOAT,
                        γεωγ_μήκος FLOAT,
                        υψόμετρο FLOAT,
                        PRIMARY KEY (id)
                    );
                    
                    CREATE TABLE IF NOT EXISTS Μ_Δεδομένα (
                        id SERIAL,
                        ημερομηνία date,
                        μέση_θερμοκρασία FLOAT,
                        μέγιστη_θερμοκρασία FLOAT,
                        ελάχιστη_θερμοκρασία FLOAT,
                        μέση_υγρασία FLOAT,
                        μέγιστη_υγρασία FLOAT,
                        ελάχιστη_υγρασία FLOAT,
                        μέση_ατμοσφ_πίεση FLOAT,
                        μέγιστη_ατμοσφ_πίεση FLOAT,
                        ελάχιστη_ατμοσφ_πίεση FLOAT,
                        ημερήσια_βροχόπτωση FLOAT,
                        μέση_ταχύτητα_ανέμου FLOAT,
                        διευθ_ανέμου VARCHAR(20),
                        μέγιστη_ριπή_ανέμου FLOAT,
                        PRIMARY KEY (id)
                    );
    
                    CREATE TABLE IF NOT EXISTS ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ (
                        idΜΣ INTEGER,
                        idΔήμοι INTEGER,
                        FOREIGN KEY(idΜΣ) references Μ_Σταθμοί(id),
                        FOREIGN KEY(idΔήμοι) references Δήμοι(id)
                    );
    
                    CREATE TABLE IF NOT EXISTS ΕΚΔΗΛΩΘΗΚΑΝ (
                        idΔΠ INTEGER,
                        idΔήμοι INTEGER,
                        FOREIGN KEY(idΔΠ) references Δασικές_Πυρκαγιές(id),
                        FOREIGN KEY(idΔήμοι) references Δήμοι(id)
                    );
    
                    CREATE TABLE IF NOT EXISTS ΚΑΤΑΓΡΑΦΕΣ (
                        idΜΣ INTEGER,
                        idΜΔ INTEGER,
                        FOREIGN KEY(idΜΣ) references Μ_Σταθμοί(id),
                        FOREIGN KEY(idΜΔ) references Μ_Δεδομένα(id)
                    );";
                    
                    $result = pg_query($link, $query) or die("Αποτυχία Ανοικοδόμισης Βάσης!"); 
                    echo "<p style='color: red'> Η βάση ανοικοδομήθηκε επιτυχώς.</p>";

                    pg_close($link);
                
                }      
                clearstatcache();
            ?>
            </form>
            <br><br><a style='color: red' href="index.php">Πίσω στην αρχική</a>

        </p>  
    </body>
</html>