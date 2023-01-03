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
            <form action="/action_page.php">
                <input type="file" id="myFile" name="filename" accept='.csv'>
                <input type="submit" id="submit">
            </form>
        </h1>
        <?php 
            if ($_POST['submit']){
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Check if file was uploaded without errors
                    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
                        if($file_type = $_FILES["simplefile"]["type"] != ".csv")
                        {
                            echo "The file you uploaded was not a '.csv' file!";
                        }
                        else{
                            $file_name = $_FILES["simplefile"]["name"];
                        }
                    }
                 }
                // attempt a connection
                $dbh = pg_connect("host=localhost dbname=blah user=user password=pass123")
                or die("Error in connection: " . pg_last_error());

                $sql = "CREATE TABLE IF NOT EXISTS fire_temp (
                            τμήμα varchar(150),
                            νομός varchar(150),
                            δήμος varchar(150),
                            ημερομηνία_έναρξης varchar(20),
                            ώρα_έναρξης varchar(20),
                            ημερομηνία_κατάσβεσης varchar(20),
                            ώρα_κατάσβεσης varchar(20),
                            καμμένη_έκταση_στρ float,
                            προσωπικό integer,
                            οχήματα integer,
                            εναέρια integer
                        );
                        \copy fire_temp FROM '/home/Data/2022-23/$file_name' DELIMITER ';' csv header NULL AS 'NULL';
                        insert into Δασικές_Πυρκαγιές (όνομα_πυρ_σώματος, ημερομ_έναρξης, ώρα_έναρξης, ημερομ_κατασβ, ώρα_κατασβ, καμμένη_έκταση, πλήθος_προσωπικού, πλήθος_οχημάτων, πλήθος_εναέριων_μέσων)
                        select τμήμα, ημερομηνία_έναρξης, ώρα_έναρξης, ημερομηνία_κατάσβεσης, ώρα_κατάσβεσης, καμμένη_έκταση_στρ, προσωπικό, οχήματα, εναέρια
                        from fire_temp;";
                
                $result = pg_query($dbh, $sql)
                or die("There was a problem uploading you data: " . pg_last_error());
            }
        ?>
       
    </body>