<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Adding "stations_list.csv" file Page</title>
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

        <h3>Προσθήκη αρχείου "stations_list.csv"</h3>
        <h1>
            <p style="color: red; width: 700pt">
                <?php            
                $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                or die("Απουχία Σύνδεσης!");

                $query="CREATE TABLE IF NOT EXISTS stations_temp (
                    station_name varchar(150),
                    latitude float,
                    longitude float,
                    altitude float
                );";
                $result = pg_query($link, $query) or die("Αποτυχία φόρτωσης αρχείου!\n");

                $output = exec('./copy_stations/copy_stations.sh') or die("Error executing exec command!!!");
                echo "<br>$output<br>";

                $query = "insert into Μ_Σταθμοί (όνομα_μετεωρ_σταθμού, γεωγ_πλάτος, γεωγ_μήκος, υψόμετρο)
                select station_name, latitude, longitude, altitude
                from stations_temp;
                drop table stations_temp;";
                
                $result = pg_query($link, $query) or die("Αποτυχία φόρτωσης αρχείου!\n");
                /*
                */
                echo "Το αρχείο φορτώθηκε επιτυχώς!";
                pg_close($link);
                clearstatcache();
                ?>
            </p>
        </h1>
    </body>
    </html>