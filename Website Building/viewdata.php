<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Home Page</title>
    </head>
    
    <body>
        <?php include 'login.php'?>
        <!--Topbar Navigation Code-->
        <div class="topnav">
            <a class="button" href="index.php">db1u10</a>
            <div class="topnav-right">
                <a href="viewnav.php">View</a>
                <a href="addnav.php">Add Row</a>
                <a href="addfilenav.php">Add File</a>
                <a href="delnav.php">Erase Row</a>
                <a href="delfilenav.php">Erase File</a>
                <a href="arc.php">Architecture</a>
            </div>
        </div>
        <!--Topbar Navigation Code-->

        <h3>Viewing Table: "Data"</h3>
        <?php
            $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                or die ("Could not connect to server\n");

            $result = pg_exec($link, "SELECT * FROM Μ_Δεδομένα;")
                or die("Cannot execute query: $query\n");

            $numrows = pg_numrows($result);
        ?>
        <table border="1">
            <tr>
                <th>id</th>
                <th>ημερομηνία</th>
                <th>μέση_θερμοκρασία</th>
                <th>μέγιστη_θερμοκρασία</th>
                <th>ελάχιστη_θερμοκρασία</th>
                <th>μέση_υγρασία</th>
                <th>μέγιστη_υγρασία</th>
                <th>ελάχιστη_υγρασία</th>
                <th>μέση_ατμοσφ_πίεση</th>
                <th>μέγιστη_ατμοσφ_πίεση</th>
                <th>ελάχιστη_ατμοσφ_πίεση</th>
                <th>ημερήσια_βροχόπτωση</th>
                <th>μέση_ταχύτητα_ανέμου</th>
                <th>διευθ_ανέμου</th>
                <th>μέγιστη_ριπή_ανέμου</th>
            </tr>
            <?php

            // Loop on rows in the result set.
            for($ri = 0; $ri < $numrows; $ri++) {
                echo "<tr>\n";
                $row = pg_fetch_array($result, $ri);
                echo " <td>", $row["Μ_Δεδομένα"], "</td>
                <td>", $row["id"], "</td>
                <td>", $row["ημερομηνία"], "</td>
                <td>", $row["μέση_θερμοκρασία"], "</td>	
                <td>", $row["μέγιστη_θερμοκρασία"], "</td>	
                <td>", $row["ελάχιστη_θερμοκρασία"], "</td>	
                <td>", $row["μέση_υγρασία"], "</td>	
                <td>", $row["μέγιστη_υγρασία"], "</td>	
                <td>", $row["ελάχιστη_υγρασία"], "</td>	
                <td>", $row["μέση_ατμοσφ_πίεση"], "</td>	
                <td>", $row["μέγιστη_ατμοσφ_πίεση"], "</td>
                <td>", $row["ελάχιστη_ατμοσφ_πίεση"], "</td>
                <td>", $row["ημερήσια_βροχόπτωση"], "</td>
                <td>", $row["μέση_ταχύτητα_ανέμου"], "</td>
                <td>", $row["διευθ_ανέμου"], "</td>
                <td>", $row["μέγιστη_ριπή_ανέμου"], "</td>
                </tr>
                ";
            }
            pg_close($link);
            ?>
    </table>
       
    </body>
</html>