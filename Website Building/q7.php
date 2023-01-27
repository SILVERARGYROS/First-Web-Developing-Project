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

        <h3>Ερώτημα Q2:<br>
        Παρουσιάστε τα ονόματα των νομών, στους οποίους χρησιμοποιήθηκαν περισσότερα από
        30 εναέρια μέσα για την κατάσβεση πυρκαγιών, στην περίοδο του καλοκαιριού του 2021
        (δηλαδή από 1/6/2021 έως 31/8/2021). Να εμφανιστεί και το ακριβές πλήθος εναέριων
        μέσων που χρησιμοποιήθηκαν εκείνη την περίοδο για κάθε νομό.</h3>
        <h3>Αποτέλεσμα:</h3>
        <?php
            $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                or die ("Αποτυχία Σύνδεσης\n");

            $result = pg_query($link, "SELECT  Δήμοι.όνομα_νομού, SUM(Δασικές_Πυρκαγιές.πλήθος_εναέριων_μέσων)
            FROM    Δήμοι, Δασικές_Πυρκαγιές, ΕΚΔΗΛΩΘΗΚΑΝ
            WHERE   ΕΚΔΗΛΩΘΗΚΑΝ.idΔήμοι = Δήμοι.id
            AND     ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ = Δασικές_Πυρκαγιές.id
            AND     Δασικές_Πυρκαγιές.πλήθος_εναέριων_μέσων > 30
            AND     Δασικές_Πυρκαγιές.ημερομ_έναρξης >= '2021-06-01'
            AND     Δασικές_Πυρκαγιές.ημερομ_έναρξης <= '2021-08-31'
            GROUP BY    Δήμοι.όνομα_νομού;")
            or die("Αποτυχία Προβολής\n");

            $rows = pg_num_rows($result);
        ?>
        <table border="1">
            <tr>
                <th>όνομα_νομού</th>
                <th>sum</th>
            </tr>
            <?php

            // Loop on rows in the result set.
            for($ri = 0; $ri < $rows; $ri++) {
                echo "<tr>\n";
                $row = pg_fetch_array($result, $ri);
                echo "<td>", $row["όνομα_νομού"], "</td>
                <td>", $row["sum"], "</td>	
                </tr>
                ";
            }
            pg_close($link);
            ?>
    </table>
       
    </body>
</html>