<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Reset Sequence Navigation Page</title>
    </head>

    <body>
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

        <h3>Καθαρισμός Σχέσης</h3>
        <h1>
            Παρακαλώ επιλέξτε τίνως δεδομένα θα θέλατε να καθαρίσετε από τη βάση.
        </h1>
        <div class="menuTitle">ΔΙΑΘΕΣΙΜΕΣ ΕΠΙΛΟΓΕΣ</div>
        <form action="clearfires.php"><button class="block">Δασικές Πυρκαγιές</button></form>
        <form action="clearlocations.php"><button class="block">Δήμοι</button></form>
        <form action="clearstations.php"><button class="block">Μ. Σταθμοί</button></form>
        <form action="cleardata.php"><button class="block">Μ. Δεδομένα</button></form>
        <form action="clearstations.php"><button class="block">ΣΤΑΘΜΟΙ_ΑΝΑΦΟΡΑΣ</button></form>
        <form action="clearoccurances.php"><button class="block">ΕΚΔΗΛΩΘΗΚΑΝ</button></form>
        <form action="clearrecordings.php"><button class="block">ΚΑΤΑΓΡΑΦΕΣ</button></form>
        <form action="settings.php"><button class="block">ΑΚΥΡΟ</button></form>
    </body>
</html>