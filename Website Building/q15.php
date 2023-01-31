<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Q15 Page</title>
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

        <h3>Ερώτημα Q15:<br>
        ΓΝα παρουσιάσετε τον θερμότερο και τον ψυχρότερο νομό, μαζί με τις πιο ακραίες μέγιστες
        κι ελάχιστες καταγεγραμμένες τους θερμοκρασίες. Ως θερμότερος νομός ορίζεται αυτός
        που έχει τον υψηλότερο μέσο όρο μέσων θερμοκρασιών, και αντίστοιχα ως ψυχρότερος
        αυτός που έχει τον χαμηλότερο.
        </h3>
        <h3>Αποτέλεσμα:</h3>
        <?php
            $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                or die ("Αποτυχία Σύνδεσης\n");

            $result = pg_query($link, "(SELECT Δήμοι.όνομα_νομού, AVG(Μ_Δεδομένα.μέση_θερμοκρασία), min(Μ_Δεδομένα.ελάχιστη_θερμοκρασία), max(Μ_Δεδομένα.μέγιστη_θερμοκρασία)
            FROM    Δήμοι, ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ, Μ_Δεδομένα
            WHERE   ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΔήμοι = Δήμοι.id
            AND     ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΜΣ = Μ_Σταθμοί.id
            AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
            AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
            AND     Μ_Δεδομένα.μέση_θερμοκρασία IS NOT NULL
            group by Δήμοι.όνομα_νομού
            order by AVG(Μ_Δεδομένα.μέση_θερμοκρασία) DESC
            LIMIT 1)
            UNION
            (SELECT Δήμοι.όνομα_νομού, AVG(Μ_Δεδομένα.μέση_θερμοκρασία), min(Μ_Δεδομένα.ελάχιστη_θερμοκρασία), max(Μ_Δεδομένα.μέγιστη_θερμοκρασία)
            FROM    Δήμοι, ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ, Μ_Δεδομένα
            WHERE   ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΔήμοι = Δήμοι.id
            AND     ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΜΣ = Μ_Σταθμοί.id
            AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
            AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
            AND     Μ_Δεδομένα.μέση_θερμοκρασία IS NOT NULL
            group by Δήμοι.όνομα_νομού
            order by AVG(Μ_Δεδομένα.μέση_θερμοκρασία) ASC
            LIMIT 1);")
            or die("Αποτυχία Προβολής\n");

            $rows = pg_num_rows($result);
        ?>
        <table border="1">
            <tr>
                <th>όνομα_νομού</th>
                <th>avg</th>
                <th>min</th>
                <th>max</th>
            </tr>
            <?php

            // Loop on rows in the result set.
            for($ri = 0; $ri < $rows; $ri++) {
                echo "<tr>\n";
                $row = pg_fetch_array($result, $ri);
                echo "<td>", $row["όνομα_νομού"], "</td>
                <td>", $row["avg"], "</td>	
                <td>", $row["min"], "</td>	
                <td>", $row["max"], "</td>	
                </tr>
                ";
            }
            pg_close($link);
            ?>
    </table>
       
    </body>
</html>