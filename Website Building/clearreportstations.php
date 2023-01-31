<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Clear Report Stations Page</title>
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

        <h3>Εκκαθάριση Δεδομένων Συσχέτισης "ΣΤΑΘΜΟΙ_ΑΝΑΦΟΡΑΣ"</h3>
        <h1>
            Εκκαθάριση βάσης από όλα τα δεδομένα της συσχέτισης "ΣΤΑΘΜΟΙ_ΑΝΑΦΟΡΑΣ".<br>
            <br>
            <p style='color: red'>
                ΠΡΟΣΟΧΗ: Αυτό θα σβήσει όλα τα δεδομένα της συσχέτισης.<br>
                <br>
                Είστε σίγουροι ότι θέλετε να συνεχίσετε;
            </p>
        </h1>
        <p style='color: red'>
            <form action="<?php $_PHP_SELF ?>" method = "GET"><input class="block" type="submit" value="ΕΚΚΑΘΑΡΙΣΗ ΣΧΕΣΗΣ" name="submit"></input>

            <?php
                if(isset($_GET["submit"]))
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                        or die ("Αποτυχία Σύνδεσης!");

                    $query = "truncate table ΣΤΑΘΜΟΣ_ΑΝΑΦΟΡΑΣ;";
                    
                    $result = pg_query($link, $query) or die("Αποτυχία εκκαθάρισης σχέσης!"); 
                    echo "<p style='color: red'> Η σχέση καθαρίστηκε επιτυχώς.</p>";

                    pg_close($link);
                
                }      
                clearstatcache();
            ?>
            </form>
            <br><br><a style='color: red' href="index.php">Πίσω στην αρχική</a>

        </p>
    </body>
</html>