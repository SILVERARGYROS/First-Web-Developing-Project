<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Q6 Page</title>
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

        <h3>Ερώτημα Q6:<br>
        Παρουσιάστε το όνομα της περιφέρειας, του νομού και του δήμου, με τις περισσότερες
        καταγεγραμμένες εκδηλώσεις δασικών πυρκαγιών, το πλήθος αυτών, όπως επίσης και το
        σύνολο των καμμένων δασικών εκτάσεων</h3>
        <h3>Αποτέλεσμα:</h3>
        <?php
            $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                or die ("Αποτυχία Σύνδεσης\n");

            $result = pg_query($link, "SELECT Δήμοι.όνομα_περιφέριας, Δήμοι.όνομα_νομού, Δήμοι.όνομα_Δήμου, COUNT(ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ), SUM(Δασικές_Πυρκαγιές.καμμένη_έκταση)
            FROM Δήμοι, ΕΚΔΗΛΩΘΗΚΑΝ, Δασικές_Πυρκαγιές
            WHERE   ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ = Δασικές_Πυρκαγιές.id
            AND     ΕΚΔΗΛΩΘΗΚΑΝ.idΔήμοι = Δήμοι.id
            GROUP BY Δήμοι.όνομα_περιφέριας, Δήμοι.όνομα_νομού, Δήμοι.όνομα_Δήμου
            ORDER BY COUNT(ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ) DESC
            LIMIT 1;")
            or die("Αποτυχία Προβολής\n");

            $rows = pg_num_rows($result);
        ?>
        <table border="1">
            <tr>
                <th>όνομα_περιφέριας</th>
                <th>όνομα_νομού</th>
                <th>όνομα_Δήμου</th>
                <th>πλήθος_δασικών_πυρκαγών</th>
                <th>σύνολο_καμμένων_εκτάσεων</th>
            </tr>
            <?php

            // Loop on rows in the result set.
            for($ri = 0; $ri < $rows; $ri++) {
                echo "<tr>\n";
                $row = pg_fetch_array($result, $ri);
                echo "<td>", $row["όνομα_περιφέριας"], "</td>
                <td>", $row["όνομα_νομού"], "</td>	
                <td>", $row["όνομα_Δήμου"], "</td>	
                <td>", $row["count"], "</td>	
                <td>", $row["sum"], "</td>	
                </tr>
                ";
            }
            pg_close($link);
            ?>
    </table>
       
    </body>
</html>