<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Settings Page</title>
    </head>

    <body>
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

        <h3>Διαθέσιμες Ρυθμίσεις</h3>
        <h1>Εδώ μπορείτε να διαχειριστείτε τις σχέσεις, τις συσχετίσεις ή ακόμα και ολόκληρη τη βάση.</h1>
        <div class="menuTitle">ΔΙΑΘΕΣΙΜΕΣ ΕΠΙΛΟΓΕΣ</div>
        <form action="arc.php"><button class="block">Αρχιτεκτονική Βάσης</button></form>
        <form action="cleartablenav.php"><button class="block">Εκκαθάριση Σχέσης</button></form>
        <form action="cleardb.php"><button class="block">Εκκαθάριση Βάσης</button></form>
        <form action="resetseqnav.php"><button class="block">Επαναφορά Αλληλουχιών Αρίθμησης Εγγραφών</button></form>
        <form action="rebuilddb.php"><button class="block">Ανοικοδόμιση Βάσης</button></form>
    </body>
</html>