<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Reset Stations Sequence Page</title>
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

        <h3>Επαναφορά Αλληλουχιών Αρίθμησης Μ. Σταθμών</h3>
        <h1>
            Επαναφορά τιμών αλληλουχιών αρίθμησης πίσω στις αρχικές τιμές <br>
            <br>
            <p style='color: red'>
                ΠΡΟΣΟΧΗ: Αυτό θα επαναφέρει την αρίθμηση εγγραφών πάλι πίσω στη μονάδα (1).<br>
                ΣΥΣΤΙΝΕΤΑΙ ΣΥΝΕΧΕΙΑ ΜΟΝΟ ΣΤΗ ΠΕΡΙΠΤΩΣΗ ΑΔΕΙΑΣ ΣΧΕΣΗΣ!<br><br>
                Είστε σίγουροι ότι θέλετε να συνεχίσετε;
            </p>
        </h1>
        <p style='color: red'>
            <form action="<?php $_PHP_SELF ?>" method = "GET"><input class="block" type="submit" value="ΕΠΑΝΑΦΟΡΑ ΑΛΛΗΛΟΥΧΙΑΣ" name="submit"></input>

            <?php
                if(isset($_GET["submit"]))
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
                        or die ("Error in connections" . pg_last_error());

                    $query = "ALTER SEQUENCE Μ_Σταθμοί_id_seq RESTART;";
                    
                    $result = pg_query($link, $query) or die("Error executing query: $query\n" . pg_last_error()); 
                    echo "<p style='color: red'> Επιτυχής επαναφορά αλληλουχίας.</p>";

                    pg_close($link);
                
                }      
                clearstatcache();
            ?>
            </form>
            <br><br><a style='color: red' href="index.php">Πίσω στην αρχική</a>

        </p>
    </body>
</html>