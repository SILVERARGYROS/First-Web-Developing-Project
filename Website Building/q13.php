<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Q13 Page</title>
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

        <h3>Ερώτημα Q13:<br>
        Παρουσιάστε τις περιφέρειες που έχουν καταγραφεί θερμοκρασίες μεγαλύτερες από X αλλά
        και θερμοκρασίες μικρότερες από Y</h3>

        <h1>Παρακαλώ εισάγεται θερμοκρασίες Χ και Υ:<br><br>
            <form action = "<?php $_PHP_SELF ?>" method = "GET">
                Θερμοκρασία Χ:<input type="number" step=any name="x"></input><br>
                Θερμοκρασία Υ:<input type="number" step=any name="y"></input><br>
                <input type="submit" value="Υποβολή" name="submit"></input>
            </form>
        </h1>
        <h3>Αποτέλεσμα:</h3>
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['x'];
                $a2 = $_GET['y'];
                if($a1 and $a2)
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                        or die ("Αποτυχία Σύνδεσης\n");
    
                    $result = pg_query($link, "SELECT  DISTINCT Δήμοι.όνομα_περιφέριας 
                    FROM    Δήμοι, ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ, Μ_Δεδομένα
                    WHERE   ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΔήμοι = Δήμοι.id
                    AND     ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΜΣ = Μ_Σταθμοί.id
                    AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
                    AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
                    AND     ((Μ_Δεδομένα.μέγιστη_θερμοκρασία > $a1
                    AND     Μ_Δεδομένα.μέγιστη_θερμοκρασία < $a2)
                    OR      (Μ_Δεδομένα.ελάχιστη_θερμοκρασία > $a1
                    AND     Μ_Δεδομένα.ελάχιστη_θερμοκρασία < $a2)
                    OR      (Μ_Δεδομένα.μέση_θερμοκρασία > $a1
                    AND     Μ_Δεδομένα.μέση_θερμοκρασία < $a2));")
                    or die("Αποτυχία Προβολής\n");
    
                    $rows = pg_num_rows($result);
                }
                else
                {
                    echo "Παρακαλώ συμπληρώστε όλα τα πεδία!\n";
                }
            }
        ?>
        <table border="1">
            <tr>
                <th>όνομα_περιφέριας</th>
            </tr>
            <?php
                if(isset($_GET["submit"]))
                {
                    $a1 = $_GET['x'];
                    $a2 = $_GET['y'];
                    if($a1 and $a2)
                    {
                        // Loop on rows in the result set.
                        for($ri = 0; $ri < $rows; $ri++) {
                            echo "<tr>\n";
                            $row = pg_fetch_array($result, $ri);
                            echo "<td>", $row["όνομα_περιφέριας"], "</td>
                            </tr>
                            ";
                        }
                        pg_close($link);
                    }
                }
            ?>
    </table>
       
    </body>
</html>