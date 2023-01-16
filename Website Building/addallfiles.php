<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Add all files Page</title>
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

        <h3>Εισαγωγή δεδομένων όλων των αρχείων</h3>
        
        <h1>
            Εισαγωγή των δεδομένων από<br>
            όλα τα διαθέσιμα αρχεία ".csv"<br>
            <br>
            <p style='color: red'>
            ΠΡΟΣΟΧΗ: Αυτό θα εισάγει στη βάση όλα τα δεδομένα από όλα τα διαθέσιμα αρχεία.<br>
                (Ίσως χρειαστεί μερικά λεπτά.)<br>
                <br>
                Είστε σίγουροι ότι θέλετε να συνεχίσετε;
            </p>
        </h1>
        <p style='color: red'>
            <form action="<?php $_PHP_SELF ?>" method = "GET"><input class="block" type="submit" value="ΕΙΣΑΓΩΓΗ ΑΡΧΕΙΩΝ" name="submit"></input>

            <?php
                if(isset($_GET["submit"]))
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                        or die ("Αποτυχία σύνδεσης!");

                    $query = "
                    CREATE TABLE IF NOT EXISTS fire_temp (
                        τμήμα varchar(150),
                        νομός varchar(150),
                        δήμος varchar(150),
                        ημερομηνία_έναρξης date,
                        ώρα_έναρξης time,
                        ημερομηνία_κατάσβεσης date,
                        ώρα_κατάσβεσης time,
                        καμμένη_έκταση_στρ float,
                        προσωπικό integer,
                        οχήματα integer,
                        εναέρια integer
                    );
                    
                    CREATE TABLE IF NOT EXISTS locations_temp (
                        περιφέρεια varchar(150),
                        νομός varchar(150),
                        δήμος varchar(150),
                        latitude float,
                        longtitude float,
                        station_of_reference varchar(150)
                    );
                    
                    CREATE TABLE IF NOT EXISTS meteo_temp (
                        station_name varchar(150),
                        date date,
                        avg_temp_C float,
                        max_temp_C float,
                        min_temp_C float,
                        avg_hum_perc float,
                        max_hum_perc float,
                        min_hum_perc float,
                        avg_atm_hPa float,
                        max_atm_hPa float,
                        min_atm_hPa float,
                        rain_mm float,
                        wind_speed_kmh float,
                        wind_dir varchar(20),
                        wind_gust_kmh float
                    );
                    
                    CREATE TABLE IF NOT EXISTS stations_temp (
                        station_name varchar(150),
                        latitude float,
                        longitude float,
                        altitude float
                    );";

                    $result = pg_query($link, $query) or die("Σφάλμα φόρτωσης Αρχείων!"); 

                    $output = exec('./copy_fires/copy_fires.sh') or die("Σφάλμα φόρτωσης Αρχείων!");

                    $output = exec('./copy_locations/copy_locations.sh') or die("Σφάλμα φόρτωσης Αρχείων!");

                    $output = exec('./copy_stations/copy_stations.sh') or die("Σφάλμα φόρτωσης Αρχείων!");

                    $output = exec('./copy_data/copy_data.sh') or die("Σφάλμα φόρτωσης Αρχείων!");
                    
                    $query = "insert into Δασικές_Πυρκαγιές (όνομα_πυρ_σώματος, ημερομ_έναρξης, ώρα_έναρξης, ημερομ_κατασβ, ώρα_κατασβ, καμμένη_έκταση, πλήθος_προσωπικού, πλήθος_οχημάτων, πλήθος_εναέριων_μέσων)
                    select τμήμα, ημερομηνία_έναρξης, ώρα_έναρξης, ημερομηνία_κατάσβεσης, ώρα_κατάσβεσης, καμμένη_έκταση_στρ, προσωπικό, οχήματα, εναέρια
                    from fire_temp;
                    
                    insert into Δήμοι (όνομα_περιφέριας, όνομα_νομού, όνομα_Δήμου, γεωγ_πλάτος, γεωγ_μήκος)
                    select περιφέρεια, νομός, δήμος, latitude, longtitude
                    from locations_temp;
                    
                    insert into Μ_Σταθμοί (όνομα_μετεωρ_σταθμού, γεωγ_πλάτος, γεωγ_μήκος, υψόμετρο)
                    select station_name, latitude, longitude, altitude
                    from stations_temp;
                    
                    insert into Μ_Δεδομένα (ημερομηνία, μέση_θερμοκρασία, μέγιστη_θερμοκρασία, ελάχιστη_θερμοκρασία, μέση_υγρασία, μέγιστη_υγρασία, ελάχιστη_υγρασία, μέση_ατμοσφ_πίεση, μέγιστη_ατμοσφ_πίεση, ελάχιστη_ατμοσφ_πίεση, ημερήσια_βροχόπτωση, μέση_ταχύτητα_ανέμου, διευθ_ανέμου, μέγιστη_ριπή_ανέμου)
                    select date, avg_temp_C, max_temp_C, min_temp_C, avg_hum_perc, max_hum_perc, min_hum_perc, avg_atm_hPa, max_atm_hPa, min_atm_hPa, rain_mm, wind_speed_kmh, wind_dir, wind_gust_kmh
                    from meteo_temp;
                    
                    insert into ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ (idΜΣ, idΔήμοι)
                    select distinct Μ_Σταθμοί.id, Δήμοι.id
                    from locations_temp, Δήμοι, Μ_Σταθμοί
                    WHERE locations_temp.δήμος = Δήμοι.όνομα_Δήμου
                    AND locations_temp.station_of_reference = Μ_Σταθμοί.όνομα_μετεωρ_σταθμού;
                        
                    insert into ΕΚΔΗΛΩΘΗΚΑΝ (idΔΠ, idΔήμοι)
                    select distinct Δασικές_Πυρκαγιές.id, Δήμοι.id
                    from Δασικές_Πυρκαγιές, Δήμοι, fire_temp
                    WHERE fire_temp.δήμος = Δήμοι.όνομα_Δήμου AND Δασικές_Πυρκαγιές.όνομα_πυρ_σώματος = fire_temp.τμήμα AND Δασικές_Πυρκαγιές.ημερομ_έναρξης = fire_temp.ημερομηνία_έναρξης AND Δασικές_Πυρκαγιές.ώρα_έναρξης = fire_temp.ώρα_έναρξης AND Δασικές_Πυρκαγιές.ημερομ_κατασβ = fire_temp.ημερομηνία_κατάσβεσης AND Δασικές_Πυρκαγιές.ώρα_κατασβ = fire_temp.ώρα_κατάσβεσης AND Δασικές_Πυρκαγιές.καμμένη_έκταση = fire_temp.καμμένη_έκταση_στρ AND Δασικές_Πυρκαγιές.πλήθος_προσωπικού = fire_temp.προσωπικό AND Δασικές_Πυρκαγιές.πλήθος_οχημάτων = fire_temp.οχήματα AND Δασικές_Πυρκαγιές.πλήθος_εναέριων_μέσων = fire_temp.εναέρια;
                    
                    insert into ΚΑΤΑΓΡΑΦΕΣ (idΜΣ, idΜΔ)
                    select distinct Μ_Σταθμοί.id, Μ_Δεδομένα.id
                    from Μ_Σταθμοί, Μ_Δεδομένα, meteo_temp
                    WHERE Μ_Σταθμοί.όνομα_μετεωρ_σταθμού = meteo_temp.station_name AND Μ_Δεδομένα.ημερομηνία = meteo_temp.date AND (Μ_Δεδομένα.μέση_θερμοκρασία = meteo_temp.avg_temp_C OR (Μ_Δεδομένα.μέση_θερμοκρασία IS NULL AND meteo_temp.avg_temp_C IS NULL)) AND (Μ_Δεδομένα.μέγιστη_θερμοκρασία = meteo_temp.max_temp_C OR (Μ_Δεδομένα.μέγιστη_θερμοκρασία IS NULL AND meteo_temp.max_temp_C IS NULL)) AND (Μ_Δεδομένα.ελάχιστη_θερμοκρασία = meteo_temp.min_temp_C OR (Μ_Δεδομένα.ελάχιστη_θερμοκρασία IS NULL AND meteo_temp.min_temp_C IS NULL)) AND (Μ_Δεδομένα.μέση_υγρασία = meteo_temp.avg_hum_perc OR (Μ_Δεδομένα.μέση_υγρασία IS NULL AND meteo_temp.avg_hum_perc IS NULL)) AND (Μ_Δεδομένα.μέγιστη_υγρασία = meteo_temp.max_hum_perc OR (Μ_Δεδομένα.μέγιστη_υγρασία IS NULL AND meteo_temp.max_hum_perc IS NULL)) AND (Μ_Δεδομένα.ελάχιστη_υγρασία = meteo_temp.min_hum_perc OR (Μ_Δεδομένα.ελάχιστη_υγρασία IS NULL AND meteo_temp.min_hum_perc IS NULL)) AND (Μ_Δεδομένα.μέση_ατμοσφ_πίεση = meteo_temp.avg_atm_hPa OR (Μ_Δεδομένα.μέση_ατμοσφ_πίεση IS NULL AND meteo_temp.avg_atm_hPa IS NULL)) AND (Μ_Δεδομένα.μέγιστη_ατμοσφ_πίεση = meteo_temp.max_atm_hPa OR (Μ_Δεδομένα.μέγιστη_ατμοσφ_πίεση IS NULL AND meteo_temp.max_atm_hPa IS NULL)) AND (Μ_Δεδομένα.ελάχιστη_ατμοσφ_πίεση = meteo_temp.min_atm_hPa OR (Μ_Δεδομένα.ελάχιστη_ατμοσφ_πίεση IS NULL AND meteo_temp.min_atm_hPa IS NULL)) AND (Μ_Δεδομένα.ημερήσια_βροχόπτωση = meteo_temp.rain_mm OR (Μ_Δεδομένα.ημερήσια_βροχόπτωση IS NULL AND meteo_temp.rain_mm IS NULL)) AND (Μ_Δεδομένα.μέση_ταχύτητα_ανέμου = meteo_temp.wind_speed_kmh OR (Μ_Δεδομένα.μέση_ταχύτητα_ανέμου IS NULL AND meteo_temp.wind_speed_kmh IS NULL)) AND (Μ_Δεδομένα.διευθ_ανέμου = meteo_temp.wind_dir OR (Μ_Δεδομένα.διευθ_ανέμου IS NULL AND meteo_temp.wind_dir IS NULL)) AND (Μ_Δεδομένα.μέγιστη_ριπή_ανέμου = meteo_temp.wind_gust_kmh OR (Μ_Δεδομένα.μέγιστη_ριπή_ανέμου IS NULL AND meteo_temp.wind_gust_kmh IS NULL));
                    
                    drop table if exists fire_temp;
                    drop table if exists locations_temp;
                    drop table if exists meteo_temp;
                    drop table if exists stations_temp;";
                    
                    $result = pg_query($link, $query) or die("Αποτυχία εισαγωγής δεδομένων!"); 
                    echo "<p style='color: red'> Τα δεδομένα εισάχθηκαν επιτυχώς.</p>";

                    pg_close($link);
                
                }      
                clearstatcache();
            ?>
            </form>
            <br><br><a style='color: red' href="index.php">Πίσω στην αρχική</a>

        </p>  
    </body>
</html>