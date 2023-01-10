<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Adding "fire_data.csv" file Page</title>
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

        <h3>Προσθήκη αρχείου "fire_data.csv"</h3>
        <h1>
            <p style="color: red; width: 700pt">
                <?php            
                $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                or die("Error in connection!");

                $query="CREATE TABLE IF NOT EXISTS fire_temp (
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
                        );";
                $result = pg_query($link, $query) or die("Error executing query: $query");

                $output = exec('./copy_fires/copy_fires.sh') or die("Error executing exec command!!!");
                echo "<br>$output<br>";

                $query = "insert into Δασικές_Πυρκαγιές (όνομα_πυρ_σώματος, ημερομ_έναρξης, ώρα_έναρξης, ημερομ_κατασβ, ώρα_κατασβ, καμμένη_έκταση, πλήθος_προσωπικού, πλήθος_οχημάτων, πλήθος_εναέριων_μέσων)
                select τμήμα, ημερομηνία_έναρξης, ώρα_έναρξης, ημερομηνία_κατάσβεσης, ώρα_κατάσβεσης, καμμένη_έκταση_στρ, προσωπικό, οχήματα, εναέρια
                from fire_temp;
                drop table fire_temp;";
                
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