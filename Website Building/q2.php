<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Q2 Page</title>
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

        <h3>Ερώτημα Q2:<br>
        Για κάθε μετεωρολογικό σταθμό, να παρουσιάσετε το όνομά του, και τις πιό ακραίες τιμές
        μέγιστης κι ελάχιστης θερμοκρασίας, μέγιστης κι ελάχιστης υγρασίας, μέγιστης ημερήσιας
        βροχόπτωσης, και μέγιστης ταχύτητας και ριπής ανέμου, που αυτός έχει καταγράψει. Παρουσιάστε τα αποτελέσματα ταξινομώντας κατά το όνομα του σταθμού σε αύξουσα σειρά.</h3>
        <h3>Αποτέλεσμα:</h3>
        <?php
            $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                or die ("Αποτυχία Σύνδεσης\n");

            $result = pg_query($link, "SELECT  Μ_Σταθμοί.όνομα_μετεωρ_σταθμού, MAX(Μ_Δεδομένα.μέγιστη_θερμοκρασία), MIN(Μ_Δεδομένα.ελάχιστη_θερμοκρασία),
            MAX(Μ_Δεδομένα.μέγιστη_υγρασία), MIN(Μ_Δεδομένα.ελάχιστη_υγρασία), MAX(Μ_Δεδομένα.ημερήσια_βροχόπτωση),
            MAX(Μ_Δεδομένα.μέση_ταχύτητα_ανέμου), MAX(Μ_Δεδομένα.μέγιστη_ριπή_ανέμου)
            FROM    Μ_Σταθμοί, Μ_Δεδομένα, ΚΑΤΑΓΡΑΦΕΣ
            WHERE   ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
            AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
            GROUP BY    όνομα_μετεωρ_σταθμού
            ORDER BY    όνομα_μετεωρ_σταθμού ASC;")
            or die("Αποτυχία Προβολής\n");

            $rows = pg_num_rows($result);
        ?>
        <table border="1">
            <tr>
                <th>όνομα_μετεωρ_σταθμού</th>
                <th>υψηλότερη_μέγιστη_θερμοκρασία</th>
                <th>χαμηλότερη_ελάχιστη_θερμοκρασία</th>
                <th>υψηλότερη_μέγιστη_υγρασία</th>
                <th>χαμηλότερη_ελάχιστη_υγρασία</th>
                <th>υψηλότερη_μέγιστη_ημερήσια_βροχόπτωση</th>
                <th>χαμηλότερη_ελάχιστη_ημερήσια_βροχόπτωση</th>
                <th>υψηλότερη_μέση_ταχύτητα_ανέμου</th>
                <th>χαμηλότερη_μέγιστη_ριπή_ανέμου</th>
            </tr>
            <?php

            // Loop on rows in the result set.
            for($ri = 0; $ri < $rows; $ri++) {
                echo "<tr>\n";
                $row = pg_fetch_array($result, $ri);
                echo "<td>", $row["όνομα_μετεωρ_σταθμού"], "</td>
                <td>", $row["max"], "</td>	
                <td>", $row["min"], "</td>	
                <td>", $row["max"], "</td>	
                <td>", $row["min"], "</td>	
                <td>", $row["max"], "</td>	
                <td>", $row["max"], "</td>	
                <td>", $row["max"], "</td>	
                </tr>
                ";
            }
            pg_close($link);
            ?>
    </table>
       
    </body>
</html>