<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10Clear Database Page</title>
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

        <h3>Πλήρη Εκκαθάριση Βάσης</h3>
        
        <h1>
            Εκκαθάριση βάσης από όλα τα υπάρχοντα δεδομένα.<br>
            <br>
            <p style='color: red'>
                ΠΡΟΣΟΧΗ: Αυτό θα σβήσει όλα τα δεδομένα μέσα στη βάση.<br>
                <br>
                Είστε σίγουροι ότι θέλετε να συνεχίσετε;
            </p>
        </h1>
        <p style='color: red'>
            <form action="<?php $_PHP_SELF ?>" method = "GET"><input class="block" type="submit" value="ΕΚΚΑΘΑΡΙΣΗ ΒΑΣΗΣ" name="submit"></input>

            <?php
                if(isset($_GET["submit"]))
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                        or die ("Error in connections" . pg_last_error());

                    $query = "truncate table Δασικές_Πυρκαγιές cascade;
                    truncate table Δήμοι cascade;
                    truncate table Μ_Σταθμοί cascade;
                    truncate table Μ_Δεδομένα cascade;
                    truncate table ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ;
                    truncate table ΕΚΔΗΛΩΘΗΚΑΝ;
                    truncate table ΚΑΤΑΓΡΑΦΕΣ;";
                    
                    $result = pg_query($link, $query) or die("Error executing query: $query\n" . pg_last_error()); 
                    echo "<p style='color: red'> Η βάση καθαρίστηκε επιτυχώς.</p>";

                    pg_close($link);
                
                }      
                clearstatcache();
            ?>
            </form>
            <br><br><a style='color: red' href="index.php">Πίσω στην αρχική</a>

        </p>  
    </body>
</html>