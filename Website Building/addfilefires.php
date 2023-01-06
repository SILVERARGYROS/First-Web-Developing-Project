<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Home Page</title>
    </head>

    <body>
        <?php include 'login.php'?>
        <!--Topbar Navigation Code-->
        <div class="topnav">
            <a class="button" href="index.php">db1u10</a>
            <div class="topnav-right">
                <a href="viewnav.php">View</a>
                <a href="addnav.php">Add Row</a>
                <a href="addfilenav.php">Add File</a>
                <a href="delnav.php">Erase Row</a>
                <a href="delfilenav.php">Erase File</a>
                <a href="arc.php">Architecture</a>
            </div>
        </div>
        <!--Topbar Navigation Code-->

        <h3>Add file</h3>
        <h1>
            Please load the '.csv' file<br>
            <form>
                <input type="file" id="file" name="file" accept='.csv'>
                <input type="submit" name="submit">
            </form>
        </h1>
        <br>
        <p style='color: red'>
            <?php 
            if (isset($_GET['submit'])){
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Check if file was uploaded without errors
                    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
                        if($file_type = $_FILES["simplefile"]["type"] != ".csv")
                        {
                            echo "The file you uploaded was not a '.csv' file!";
                        }
                        else{
                            $file = $_FILES["simplefile"]["name"];
                            echo "file = $file<br>";
                        }
                    }
                }
                // attempt a connection
                $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                or die("Error in connection: " . pg_last_error());
                
                $query = "CREATE TABLE IF NOT EXISTS fire_temp (
                            τμήμα varchar(150),
                            νομός varchar(150),
                            δήμος varchar(150),
                            ημερομηνία_έναρξης date(20),
                            ώρα_έναρξης time(20),
                            ημερομηνία_κατάσβεσης date(20),
                            ώρα_κατάσβεσης time(20),
                            καμμένη_έκταση_στρ float,
                            προσωπικό integer,
                            οχήματα integer,
                            εναέρια integer
                        );
                        \copy fire_temp FROM '/home/Data/2022-23/$file' DELIMITER ';' csv header NULL AS 'NULL';
                        insert into Δασικές_Πυρκαγιές (όνομα_πυρ_σώματος, ημερομ_έναρξης, ώρα_έναρξης, ημερομ_κατασβ, ώρα_κατασβ, καμμένη_έκταση, πλήθος_προσωπικού, πλήθος_οχημάτων, πλήθος_εναέριων_μέσων)
                        select τμήμα, ημερομηνία_έναρξης, ώρα_έναρξης, ημερομηνία_κατάσβεσης, ώρα_κατάσβεσης, καμμένη_έκταση_στρ, προσωπικό, οχήματα, εναέρια
                        from fire_temp;
                        drop table fire_temp;";
                
                $result = pg_query($link, $query)
                or die("Error in uploading: " . pg_last_error());
            }
            ?>
        </p>
    </body>
</html>