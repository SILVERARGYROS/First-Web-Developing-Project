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

        <h3>Ερώτημα Q1:<br>
        Να παρουσιάσετε για κάθε περιφέρεια, για κάθε νομό, για κάθε δήμο, τις συντεταγμένες
του, με αλφαβητική σειρά (κατά την προαναφερθείσα σειρά ζητουμένων).</h3>
        <h3>Αποτέλεσμα:</h3>
        <?php
            $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                or die ("Αποτυχία Σύνδεσης\n");

            $result = pg_query($link, "SELECT  όνομα_περιφέριας, όνομα_νομού, όνομα_Δήμου, γεωγ_πλάτος, γεωγ_μήκος  
            FROM    Δήμοι
            GROUP BY    όνομα_περιφέριας, όνομα_νομού, όνομα_Δήμου, γεωγ_πλάτος, γεωγ_μήκος
            ORDER BY    όνομα_περιφέριας ASC, όνομα_νομού ASC, όνομα_Δήμου ASC;")
            or die("Αποτυχία Προβολής\n");

            $rows = pg_num_rows($result);
        ?>
        <table border="1">
            <tr>
                <th>όνομα_περιφέριας</th>
                <th>όνομα_νομού</th>
                <th>όνομα_Δήμου</th>
                <th>γεωγ_πλάτος</th>
                <th>γεωγ_μήκος</th>
            </tr>
            <?php

            // Loop on rows in the result set.
            for($ri = 0; $ri < $rows; $ri++) {
                echo "<tr>\n";
                $row = pg_fetch_array($result, $ri);
                echo "<td>", $row["όνομα_περιφέριας"], "</td>
                <td>", $row["όνομα_νομού"], "</td>	
                <td>", $row["όνομα_Δήμου"], "</td>	
                <td>", $row["γεωγ_πλάτος"], "</td>	
                <td>", $row["γεωγ_μήκος"], "</td>	
                </tr>
                ";
            }
            pg_close($link);
            ?>
    </table>
       
    </body>
</html>