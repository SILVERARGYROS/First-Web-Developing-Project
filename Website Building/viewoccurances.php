<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 View Occurances Page</title>
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

        <h3>Προβολή: "ΕΚΔΗΛΩΘΗΚΑΝ"</h3>
        <?php
            $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                or die ("Αποτυχία Σύνδεσης\n");

            $result = pg_query($link, "SELECT * FROM ΕΚΔΗΛΩΘΗΚΑΝ;")
                or die("Αποτυχία Προβολής\n");

            $numrows = pg_num_rows($result);
        ?>
        <table border="1">
            <tr>
                <th>idΔΠ</th>
                <th>idΔήμοι</th>
            </tr>
            <?php

            // Loop on rows in the result set.
            for($ri = 0; $ri < $numrows; $ri++) {
                echo "<tr>\n";
                $row = pg_fetch_array($result, $ri);
                echo " <td>", $row["idΔΠ"], "</td>
                <td>", $row["idΔήμοι"], "</td>
                </tr>
                ";
            }
            pg_close($link);
            ?>
    </table>
       
    </body>
</html>