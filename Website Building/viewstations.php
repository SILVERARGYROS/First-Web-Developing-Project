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

        <h3>Viewing Table: "Stations"</h3>
        <?php
            $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                or die ("Could not connect to server\n");

            $result = pg_query($link, "SELECT * FROM Μ_Σταθμοί;")
                or die("Cannot execute query: $query\n");

            $numrows = pg_numrows($result);
        ?>
        <table border="1">
            <tr>
                <th>id</th>
                <th>όνομα_μετεωρ_σταθμού</th>
                <th>γεωγ_πλάτος</th>
                <th>γεωγ_μήκος</th>
                <th>υψόμετρο</th>
            </tr>
            <?php

            // Loop on rows in the result set.
            for($ri = 0; $ri < $numrows; $ri++) {
                echo "<tr>\n";
                $row = pg_fetch_array($result, $ri);
                echo " <td>", $row["id"], "</td>
                <td>", $row["όνομα_μετεωρ_σταθμού"], "</td>
                <td>", $row["γεωγ_πλάτος"], "</td>	
                <td>", $row["γεωγ_μήκος"], "</td>	
                <td>", $row["υψόμετρο"], "</td>	
                </tr>
                ";
            }
            pg_close($link);
            ?>
    </table>
       
    </body>
</html>