<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Add Station Page</title>
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

        <h3>Προσθήκη Μετεορολογικού Σταθμού</h3>
        <h1>
            <form action = "<?php $_PHP_SELF ?>" method = "GET">
            Παρακαλώ συμπληρώστε όλα τα ακόλουθα πεδία.<br><br>

            όνομα_μετεωρ_σταθμού:
            <input type="text" name="όνομα_μετεωρ_σταθμού"></input><br>
            γεωγ_πλάτος:
            <input type="number" name="γεωγ_πλάτος"></input><br>
            γεωγ_μήκος:
            <input type="number" name="γεωγ_μήκος"></input><br>
            υψόμετρο:
            <input type="number" name="υψόμετρο"></input><br>

            <button type="reset" value="reset" name="resetfields">Καθαρισμός Πεδίων</button>
            <input type="submit" value="Υποβολή" name="submit"></input>
        </h1>  
        <p style='color: red'>   
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['όνομα_μετεωρ_σταθμού'];
                $a2 = $_GET['γεωγ_πλάτος'];
                $a3 = $_GET['γεωγ_μήκος'];
                $a4 = $_GET['υψόμετρο'];

                if($a1 && $a2 && $a3 && $a4) {  

                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                        or die ("Error in connections" . pg_last_error());

                    $result = pg_query($link, "SELECT * FROM Μ_Σταθμοί WHERE όνομα_μετεωρ_σταθμού='$a1' AND γεωγ_πλάτος=$a2 AND γεωγ_μήκος=$a3 
                    AND υψόμετρο=$a4;");
                    
                    $rows = pg_num_rows($result);

                    if($rows>0)
                    {
                        echo "Το στοιχείο που επιχειρήσατε να προσθέσετε υπάρχει ήδη στη βάση!";
                    }
                    else{
                        $query = "INSERT INTO Μ_Σταθμοί(id, όνομα_μετεωρ_σταθμού, γεωγ_πλάτος, γεωγ_μήκος, υψόμετρο) VALUES (default,'$a1',$a2,$a3,$a4);";
                        
                        $result = pg_query($link, $query) or die("Error executing query: $query\n" . pg_last_error()); 
                        echo "Το στοιχείο προστέθηκε επιτυχώς.";
                    }

                    pg_close($link);
                }
                else
                {
                    echo "Παρακαλώ συμπληρώστε όλα τα πεδία!\n";
                }
            }      
            clearstatcache();
        ?>
        </p>
    </body>
</html>