<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Q9 Page</title>
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

        <h3>Ερώτημα Q9:<br>
        Να βρείτε τα μετεωρολογικά δεδομένα του σταθμού με όνομα X για την περίοδο από την
        ημερομηνία x1 έως την ημερομηνία x2, εκτός από την περίοδο ημερομηνιών καταγραφής y1
        έως y2.
        </h3>

        <h1>Παρακαλώ εισάγεται όνομα σταθμού Χ 
            χρονική περίοδο x1 εώς x2
            και περίοδο εξαίρεσης y1 εώς y2:<br><br>
            <form action = "<?php $_PHP_SELF ?>" method = "GET">
                Όνομα Σταθμού:<input type="text" name="x"></input><br>
                Ημ. Αρχής #1: <input type="date" name="x1"></input><br>
                Ημ. Τέλους #1:<input type="date" name="x2"></input><br>
                Ημ. Αρχής #2: <input type="date" name="y1"></input><br>
                Ημ. Τέλους #2:<input type="date" name="y2"></input><br>
                <input type="submit" value="Υποβολή" name="submit"></input>
            </form>
        </h1>
        <h3>Αποτέλεσμα:</h3>
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['x'];
                $a2 = $_GET['x1'];
                $a3 = $_GET['x2'];
                $a4 = $_GET['y1'];
                $a5 = $_GET['y2'];
                if($a1 and $a2 and $a3 and $a4 and $a5)
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                        or die ("Αποτυχία Σύνδεσης\n");
    
                    $result = pg_query($link, "SELECT  Μ_Δεδομένα.*
                    FROM    Μ_Δεδομένα, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ   
                    WHERE   Μ_Σταθμοί.όνομα_μετεωρ_σταθμού = '$a1'
                    AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
                    AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
                    AND     Μ_Δεδομένα.ημερομηνία >= '$a2'
                    AND     Μ_Δεδομένα.ημερομηνία <= '$a3'
                    EXCEPT  
                    SELECT  Μ_Δεδομένα.*
                    FROM    Μ_Δεδομένα, Μ_Σταθμοί, ΚΑΤΑΓΡΑΦΕΣ   
                    WHERE   Μ_Σταθμοί.όνομα_μετεωρ_σταθμού = 'aghiosnikolaos'
                    AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΣ = Μ_Σταθμοί.id
                    AND     ΚΑΤΑΓΡΑΦΕΣ.idΜΔ = Μ_Δεδομένα.id
                    AND     Μ_Δεδομένα.ημερομηνία >= '$a4'
                    AND     Μ_Δεδομένα.ημερομηνία <= '$a5';");
    
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
                if(isset($_GET["submit"]))
                {
                    $a1 = $_GET['x'];
                    $a2 = $_GET['x1'];
                    $a3 = $_GET['x2'];
                    $a4 = $_GET['y1'];
                    $a5 = $_GET['y2'];
                    if($a1 and $a2 and $a3 and $a4 and $a5)
                    {
                        // Loop on rows in the result set.
                        for($ri = 0; $ri < $rows; $ri++) {
                            echo "<tr>\n";
                            $row = pg_fetch_array($result, $ri);
                            echo "<td>", $row["id"], "</td>
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
                    }
                }
            ?>
        </table>
       
    </body>
</html>