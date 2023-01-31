<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Q14 Page</title>
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

        <h3>Ερώτημα Q14:<br>
        Παρουσιάστε τις X πιο καταστροφικές δασικές πυρκαγιές μέχρι και το 2020. Για κάθε μία
        από αυτές, να εμφανίσετε: την ημερομηνία έναρξης, την ώρα έναρξης, το νομό και τον
        δήμο στους οποίους εκδηλώθηκαν, την καμμένη έκταση, τη μέγιστη θερμοκρασία, τη μέση
        υγρασία, την ταχύτητα του ανέμου, και τη μέγιστη ριπή ανέμου που καταγράφηκαν εκείνη
        τη μέρα. Να εμφανιστούν με φθίνουσα σειρά βάσει των καμμένων εκτάσεων.</h3>

        <h1>Παρακαλώ εισάγετε αριθμό Χ:<br><br>
            <form action = "<?php $_PHP_SELF ?>" method = "GET">
                Αριθμός Πυρκαγών:<input type="text" name="x"></input><br>
                <input type="submit" value="Υποβολή" name="submit"></input>
            </form>
        </h1>
        <h3>Αποτέλεσμα:</h3>
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['x'];
                if($a1)
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                        or die ("Αποτυχία Σύνδεσης\n");
    
                    $result = pg_query($link, "SELECT DISTINCT Δασικές_Πυρκαγιές.ημερομ_έναρξης, Δασικές_Πυρκαγιές.ώρα_έναρξης, 
                    Δήμοι.όνομα_νομού, Δήμοι.όνομα_Δήμου, Δασικές_Πυρκαγιές.καμμένη_έκταση, 
                    Μ_Δεδομένα.μέγιστη_θερμοκρασία, Μ_Δεδομένα.μέση_υγρασία, Μ_Δεδομένα.μέση_ταχύτητα_ανέμου, Μ_Δεδομένα.μέγιστη_ριπή_ανέμου
                    FROM    Δασικές_Πυρκαγιές, ΕΚΔΗΛΩΘΗΚΑΝ, Δήμοι, ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ, Μ_Δεδομένα
                    WHERE   ΕΚΔΗΛΩΘΗΚΑΝ.idΔήμοι = Δήμοι.id
                    AND     ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ = Δασικές_Πυρκαγιές.id
                    AND     ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΔήμοι = Δήμοι.id
                    AND     ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ.idΜΣ = Μ_Σταθμοί.id
                    AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
                    AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
                    AND     Δασικές_Πυρκαγιές.ημερομ_έναρξης <= '2020-12-31'
                    AND     Δασικές_Πυρκαγιές.ημερομ_έναρξης = Μ_Δεδομένα.ημερομηνία
                    ORDER BY Δασικές_Πυρκαγιές.καμμένη_έκταση DESC
                    LIMIT   $a1;")
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
                <th>ημερομ_έναρξης</th>
                <th>ώρα_έναρξης</th>
                <th>όνομα_νομού</th>
                <th>όνομα_Δήμου</th>
                <th>καμμένη_έκταση</th>
                <th>μέγιστη_θερμοκρασία</th>
                <th>μέση_υγρασία</th>
                <th>μέση_ταχύτητα_ανέμου</th>
                <th>μέγιστη_ριπή_ανέμου</th>
            </tr>
            <?php
                if(isset($_GET["submit"]))
                {
                    $a1 = $_GET['x'];
                    if($a1)
                    {
                        // Loop on rows in the result set.
                        for($ri = 0; $ri < $rows; $ri++) {
                            echo "<tr>\n";
                            $row = pg_fetch_array($result, $ri);
                            echo "<td>", $row["ημερομ_έναρξης"], "</td>
                            <td>", $row["ώρα_έναρξης"], "</td>	
                            <td>", $row["όνομα_νομού"], "</td>	
                            <td>", $row["όνομα_Δήμου"], "</td>	
                            <td>", $row["καμμένη_έκταση"], "</td>	
                            <td>", $row["μέγιστη_θερμοκρασία"], "</td>	
                            <td>", $row["μέση_υγρασία"], "</td>	
                            <td>", $row["μέση_ταχύτητα_ανέμου"], "</td>	
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