<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Q1 Page</title>
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
        του, με αλφαβητική σειρά (κατά την προαναφερθείσα σειρά ζητουμένων). Η παρουσίαση να
        γίνει με την συγκεκριμένη μορφή που αναφέρεται στην εκφώνηση.</h3>
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
        <pre style="background-color: black;font-size: x-large;">
        <?php
        echo "\r";
        // Loop on rows in the result set.
        $c1 = 0;    //requested counters at the end of each line
        $c2 = 0;
        $c3 = 0;
        $row2;      //temp row
        for($i = 0; $i < $rows; $i++) {
            $row = pg_fetch_array($result, $i);
            if($i == 0)
            {
                $c1++;
                $c2 = 0;
                $c3 = 0;
                echo $row["όνομα_περιφέριας"], " $c1", "<br>"; 
                $c2++;
                $c3 = 0;
                echo "\t", $row["όνομα_νομού"], " $c1.$c2", "<br>"; 	
                $c3++;
                echo "\t\t", $row["όνομα_Δήμου"], " $c1.$c2.$c3: ", $row["γεωγ_πλάτος"], ", ", $row["γεωγ_μήκος"], "<br>"; 	
                $row2 = $row;
                continue;
            }
            
            if($row["όνομα_περιφέριας"] != $row2["όνομα_περιφέριας"]){
                $c1++;
                $c2 = 0;
                $c3 = 0;
                echo $row["όνομα_περιφέριας"], " $c1", "<br>"; 
            }
            if($row["όνομα_νομού"] != $row2["όνομα_νομού"]){
                $c2++;
                $c3 = 0;
                echo "\t", $row["όνομα_νομού"], " $c1.$c2", "<br>"; 	
            }
            $c3++;
            echo "\t\t", $row["όνομα_Δήμου"], " $c1.$c2.$c3: ", $row["γεωγ_πλάτος"], ", ", $row["γεωγ_μήκος"], "<br>"; 	
            $row2 = $row;
        }

        pg_close($link);

        ?>
        </pre>

    </body>
</html>