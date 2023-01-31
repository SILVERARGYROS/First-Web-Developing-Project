<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Q11 Page</title>
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

        <h3>Ερώτημα Q11:<br>
        Παρουσιάστε τα ονόματα των περιφερειών και των νομών με τις 5 μεγαλύτερες κατά μέσο
        όρο μετρήσεις (τους 5 μεγαλύτερους μέσους όρους) της μέσης υγρασίας. Να παρουσιάσετε
        και τους μέσους όρους των μέσων υγρασιών, για κάθε έναν από αυτούς.
        </h3>
        <h3>Αποτέλεσμα:</h3>
        <?php
            $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                or die ("Αποτυχία Σύνδεσης\n");

            $result = pg_query($link, "SELECT  Δήμοι.όνομα_περιφέριας, Δήμοι.όνομα_νομού, AVG(Μ_Δεδομένα.μέση_υγρασία)
            FROM    Δήμοι, ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ, Μ_Δεδομένα
            WHERE   ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΔήμοι = Δήμοι.id
            AND     ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΜΣ = Μ_Σταθμοί.id
            AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
            AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
            GROUP BY Δήμοι.όνομα_περιφέριας, Δήμοι.όνομα_νομού
            ORDER BY AVG(Μ_Δεδομένα.μέση_υγρασία) DESC
            LIMIT   5;")
            or die("Αποτυχία Προβολής\n");

            $rows = pg_num_rows($result);
        ?>
        <table border="1">
            <tr>
                <th>όνομα_περιφέριας</th>
                <th>όνομα_νομού</th>
                <th>avg</th>
            </tr>
            <?php

            // Loop on rows in the result set.
            for($ri = 0; $ri < $rows; $ri++) {
                echo "<tr>\n";
                $row = pg_fetch_array($result, $ri);
                echo "<td>", $row["όνομα_περιφέριας"], "</td>
                <td>", $row["όνομα_νομού"], "</td>	
                <td>", $row["avg"], "</td>	
                </tr>
                ";
            }
            pg_close($link);
            ?>
    </table>
       
    </body>
</html>