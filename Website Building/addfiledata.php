<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Adding "meteo_data.csv" file Page</title>
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

        <h3>Προσθήκη αρχείου "meteo_data.csv"</h3>
        <h1>
            <p style="color: red; width: 700pt">
                <?php            
                $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                or die("Error in connection!");

                $query="CREATE TABLE IF NOT EXISTS meteo_temp (
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
                );";
                $result = pg_query($link, $query) or die("Error executing query: $query");

                $output = exec('./copy_data/copy_data.sh') or die("Error executing exec command!!!");
                echo "<br>$output<br>";

                $query = "insert into Μ_Δεδομένα (ημερομηνία, μέση_θερμοκρασία, μέγιστη_θερμοκρασία, ελάχιστη_θερμοκρασία, μέση_υγρασία, μέγιστη_υγρασία, ελάχιστη_υγρασία, μέση_ατμοσφ_πίεση, μέγιστη_ατμοσφ_πίεση, ελάχιστη_ατμοσφ_πίεση, ημερήσια_βροχόπτωση, μέση_ταχύτητα_ανέμου, διευθ_ανέμου, μέγιστη_ριπή_ανέμου)
                select date, avg_temp_C, max_temp_C, min_temp_C, avg_hum_perc, max_hum_perc, min_hum_perc, avg_atm_hPa, max_atm_hPa, min_atm_hPa, rain_mm, wind_speed_kmh, wind_dir, wind_gust_kmh
                from meteo_temp;
                drop table meteo_temp;";
                
                $result = pg_query($link, $query) or die("Error executing query: $query");
                /*
                */
                echo "File loaded successfully.";
                pg_close($link);
                clearstatcache();
                ?>
            </p>
        </h1>
    </body>
    </html>