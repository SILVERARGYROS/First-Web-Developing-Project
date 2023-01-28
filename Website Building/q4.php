<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 View Fires Page</title>
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

        <h3>Ερώτημα Q4:<br>
        Για κάθε περιφέρεια παρουσιάστε τον συνολικό αριθμό καμμένων δασικών εκτάσεων, με
        φθίνουσα σειρά βάσει της καμμένης έκτασης σε στρέμματα.</h3>
        <h3>Αποτέλεσμα:</h3>
        <?php
            $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                or die ("Αποτυχία Σύνδεσης\n");

            $result = pg_query($link, "SELECT  Δήμοι.όνομα_περιφέριας, SUM(Δασικές_Πυρκαγιές.καμμένη_έκταση) as Συνολικός_αριθμός_καμμένων_δασικών_εκτάσεων
            FROM    Δήμοι, Δασικές_Πυρκαγιές, ΕΚΔΗΛΩΘΗΚΑΝ
            WHERE   ΕΚΔΗΛΩΘΗΚΑΝ.idΔήμοι = Δήμοι.id
            AND     ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ = Δασικές_Πυρκαγιές.id
            GROUP BY Δήμοι.όνομα_περιφέριας
            ORDER BY SUM(Δασικές_Πυρκαγιές.καμμένη_έκταση) DESC;")
            or die("Αποτυχία Προβολής\n");

            $rows = pg_num_rows($result);
        ?>
        <table border="1">
            <tr>
                <th>όνομα_περιφέριας</th>
                <th>Συνολικός_αριθμός_καμμένων_δασικών_εκτάσεων</th>
            </tr>
            <?php

            // Loop on rows in the result set.
            for($ri = 0; $ri < $rows; $ri++) {
                echo "<tr>\n";
                $row = pg_fetch_array($result, $ri);
                echo "<td>", $row["όνομα_περιφέριας"], "</td>
                <td>", $row["Συνολικός_αριθμός_καμμένων_δασικώ"], "</td>	
                </tr>
                ";
            }
            pg_close($link);
            ?>
    </table>
       
    </body>
</html>