<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Delete Fires Pages</title>
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

        <h3>Διαγραφή Δασικής Πυρκαγίας</h3>
        <h1>
            <form action = "<?php $_PHP_SELF ?>" method = "GET">
            Παρακαλώ συμπληρώστε όλα τα ακόλουθα πεδία.<br><br>

            όνομα_πυρ_σώματος:
            <input type="text" name="όνομα_πυρ_σώματος"></input><br>
            ημερομ_έναρξης:
            <input type="date" name="ημερομ_έναρξης"></input><br>
            ώρα_έναρξης:
            <input type="time" name="ώρα_έναρξης"></input><br>
            ημερομ_κατασβ:
            <input type="date" name="ημερομ_κατασβ"></input><br>
            ώρα_κατασβ:
            <input type="time" name="ώρα_κατασβ"></input><br>
            καμμένη_έκταση:
            <input type="number" step=any name="καμμένη_έκταση"></input><br>
            πλήθος_προσωπικού:
            <input type="number" name="πλήθος_προσωπικού"></input><br>
            πλήθος_οχημάτων:
            <input type="number" name="πλήθος_οχημάτων"></input><br>
            πλήθος_εναέριων_μέσων:
            <input type="number" name="πλήθος_εναέριων_μέσων"></input><br>

            <button type="reset" value="reset" name="resetfields">Καθαρισμός Πεδίων</button>
            <input type="submit" value="submit" name="submit"></input>
        </h1>  
        <p style='color: red'>   
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['όνομα_πυρ_σώματος'];
                $a2 = $_GET['ημερομ_έναρξης'];
                $a3 = $_GET['ώρα_έναρξης'];
                $a4 = $_GET['ημερομ_κατασβ'];
                $a5 = $_GET['ώρα_κατασβ'];
                $a6 = $_GET['καμμένη_έκταση'];
                $a7 = $_GET['πλήθος_προσωπικού'];
                $a8 = $_GET['πλήθος_οχημάτων'];
                $a9 = $_GET['πλήθος_εναέριων_μέσων'];

                if($a1 && $a2 && $a3 && $a4 && $a5 && $a6 && $a7 && $a8 && $a9) {  

                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                        or die ("Αποτυχία Σύνδεσης!");

                    $result = pg_query($link, "SELECT * FROM Δασικές_Πυρκαγιές WHERE όνομα_πυρ_σώματος='$a1' AND ημερομ_έναρξης='$a2' AND ώρα_έναρξης='$a3' 
                    AND ημερομ_κατασβ='$a4' AND ώρα_κατασβ='$a5' AND καμμένη_έκταση=$a6 AND πλήθος_προσωπικού=$a7 AND πλήθος_οχημάτων=$a8 AND πλήθος_εναέριων_μέσων=$a9;");
                    
                    $rows = pg_num_rows($result);

                    if($rows<1)
                    {
                        echo "Το στοιχείο που επιχειρήσατε να διαγράψετε δεν υπάρχει στη βάση!";
                    }
                    else{
                        $row = pg_fetch_array($result, 0);
                        $fireID = $row["id"];
                        
                        $query = "DELETE FROM Δασικές_Πυρκαγιές WHERE όνομα_πυρ_σώματος='$a1' AND ημερομ_έναρξης='$a2' AND ώρα_έναρξης='$a3' AND ημερομ_κατασβ='$a4' 
                        AND ώρα_κατασβ='$a5' AND καμμένη_έκταση=$a6 AND πλήθος_προσωπικού=$a7 AND πλήθος_οχημάτων=$a8 AND πλήθος_εναέριων_μέσων=$a9;";
                        $result = pg_query($link, $query) or die("Αποτυχία διαγραφής στοιχείου!\n"); 

                        $result = pg_query($link, "DELETE FROM ΕΚΔΗΛΩΘΗΚΑΝ WHERE idΔΠ = $fireID;");
                        echo "Το στοιχείο διαγραφτηκε επιτυχώς.";
                    }

                    pg_close($link);
                }
                else
                {
                    echo "Παρακαλώ συμπληρώστε όλα τα πεδία!\n";
                }
            }      
            clearstatcache();
        ?>
        </p>
    </body>
</html>