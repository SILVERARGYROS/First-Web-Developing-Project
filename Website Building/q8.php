<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Q8 Page</title>
    </head>
    
    <body>
        <?php include 'login.php'?>
        <!--Topbar Navigation Code-->
        <div class="topnav">
            <a class="button" href="homePage.php">db1u10</a>
            <div class="topnav-right">
                <a href="viewnav.php">Προβολή</a>
                <a href="addnav.php">Προσθήκη Εγγραφής</a>
                <a href="delnav.php">Διαγραφή Εγγραφής</a>
                <a href="addallfiles.php">Προσθήκη Αρχείων</a>
                <a href="settings.php">Ρυθμίσεις</a>
            </div>
        </div>
        <!--Topbar Navigation Code-->

        <h3>Ερώτημα Q8:<br>
        Να βρείτε τα ονόματα των μετεωρολογικών σταθμών και τις ημερομηνίες καταγραφής, κατά
        τις οποίες υπήρχαν μετεωρολογικές συνθήκες: μέγιστη θερμοκρασία ≥ X, μέση υγρασία <
        Y, και μέγιστη ριπή ανέμου > Z. Παρουσιάστε και τις τιμές για την μέγιστη θερμοκρασία,
        την μέση υγρασία και την μέγιστη ριπή ανέμου και ταξινομήστε τα αποτελέσματα κατά το
        όνομα του σταθμού σε αύξουσα σειρά.</h3>

        <h1>Παρακαλώ εισάγεται μέγιστη θερμοκρασία Χ:<br><br>
            μέση υγρασία Y και μέγιστη ριπή ανέμου Ζ:
            <form action = "<?php $_PHP_SELF ?>" method = "GET">
                Θερμοκρασία:<input type="number" step=any name="θερμοκρασία"></input><br>
                Υγρασία:<input type="number" step=any name="υγρασία"></input><br>
                Ριπή:<input type="number" step=any name="ριπή"></input><br>
                <input type="submit" value="Υποβολή" name="submit"></input>
            </form>
        </h1>
        <h3>Αποτέλεσμα:</h3>
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['θερμοκρασία'];
                $a2 = $_GET['υγρασία'];
                $a3 = $_GET['ριπή'];
                if($a1 and $a2 and $a3)
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                        or die ("Αποτυχία Σύνδεσης\n");
    
                    $result = pg_query($link, "SELECT  Μ_Σταθμοί.όνομα_μετεωρ_σταθμού, Μ_Δεδομένα.ημερομηνία, Μ_Δεδομένα.μέγιστη_θερμοκρασία, Μ_Δεδομένα.μέση_υγρασία, Μ_Δεδομένα.μέγιστη_ριπή_ανέμου
                    FROM    Μ_Σταθμοί, Μ_Δεδομένα, ΚΑΤΑΓΡΑΦΕΣ
                    WHERE   ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
                    AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
                    AND     Μ_Δεδομένα.μέγιστη_θερμοκρασία >= $a1
                    AND     Μ_Δεδομένα.μέση_υγρασία < $a2
                    AND     Μ_Δεδομένα.μέγιστη_ριπή_ανέμου > $a3
                    ORDER BY   Μ_Σταθμοί.όνομα_μετεωρ_σταθμού ASC;")
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
                <th>όνομα_μετεωρ_σταθμού</th>
                <th>ημερομηνία</th>
                <th>μέγιστη_θερμοκρασία</th>
                <th>μέση_υγρασία</th>
                <th>μέγιστη_ριπή_ανέμου</th>
            </tr>
            <?php
                if(isset($_GET["submit"]))
                {
                    $a1 = $_GET['θερμοκρασία'];
                    $a2 = $_GET['υγρασία'];
                    $a3 = $_GET['ριπή'];
                    if($a1 and $a2 and $a3)
                    {
                        // Loop on rows in the result set.
                        for($ri = 0; $ri < $rows; $ri++) {
                            echo "<tr>\n";
                            $row = pg_fetch_array($result, $ri);
                            echo "<td>", $row["όνομα_μετεωρ_σταθμού"], "</td>
                            <td>", $row["ημερομηνία"], "</td>	
                            <td>", $row["μέγιστη_θερμοκρασία"], "</td>	
                            <td>", $row["μέση_υγρασία"], "</td>	
                            <td>", $row["μέγιστη_ριπή_ανέμου"], "</td>	
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