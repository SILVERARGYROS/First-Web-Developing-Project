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

        <h3>Delete Location</h3>
        <h1>
            <form action = "<?php $_PHP_SELF ?>" method = "GET">
            Please fill all the column values to insert row in table.<br><br>

            όνομα_περιφέριας:
            <input type="text" name="όνομα_περιφέριας"></input><br>
            όνομα_νομού:
            <input type="text" name="όνομα_νομού"></input><br>
            όνομα_Δήμου:
            <input type="text" name="όνομα_Δήμου"></input><br>
            γεωγ_πλάτος:
            <input type="number" name="γεωγ_πλάτος"></input><br>
            γεωγ_μήκος:
            <input type="number" name="γεωγ_μήκος"></input><br>

            <button type="reset" value="reset" name="resetfields">Clear Fields</button>
            <input type="submit" value="submit" name="submit"></input>
        </h1>  
        <p style='color: red'>   
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['όνομα_περιφέριας'];
                $a2 = $_GET['όνομα_νομού'];
                $a3 = $_GET['όνομα_Δήμου'];
                $a4 = $_GET['γεωγ_πλάτος'];
                $a5 = $_GET['γεωγ_μήκος'];

                if($a1 && $a2 && $a3 && $a4 && $a5) {  

                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                        or die ("Error in connections" . pg_last_error());

                    $result = pg_query($link, "SELECT * FROM Δήμοι WHERE όνομα_περιφέριας='$a1' AND όνομα_νομού='$a2' AND όνομα_Δήμου='$a3' 
                    AND γεωγ_πλάτος=$a4 AND γεωγ_μήκος=$a5;");
                    
                    $rows = pg_NumRows($result);

                    if($rows<1)
                    {
                        echo "Element you tried to delete doesn't exists!";
                    }
                    else{
                        $query = "DELETE FROM Δήμοι WHERE όνομα_περιφέριας='$a1' AND όνομα_νομού='$a2' AND όνομα_Δήμου='$a3' 
                        AND γεωγ_πλάτος=$a4 AND γεωγ_μήκος=$a5;";
                        
                        $result = pg_query($link, $query) or die("Error executing query: $query\n" . pg_last_error()); 
                        echo "Element found and deleted successfully.";
                    }

                    pg_close($link);
                }
                else
                {
                    echo "Please fill all areas!\n";
                }
            }      
            clearstatcache();
        ?>
        </p>
    </body>
</html>