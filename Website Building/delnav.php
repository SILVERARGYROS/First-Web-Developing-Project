<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Erase Row Navigation Page</title>
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

        <h3>Διαγραφή Εγγραφής</h3>
        <h1>
            Παρακαλώ επιλέξτε τι θα θέλατε να αφαιρέσετε.
        </h1>
        <div class="menuTitle">ΔΙΑΘΕΣΙΜΕΣ ΕΠΙΛΟΓΕΣ</div>
        <form action="delfires.php"><button class="block">Δασική Πυρκαγιά</button></form>
        <form action="dellocations.php"><button class="block">Δήμο</button></form>
        <form action="delstations.php"><button class="block">Μ. Σταθμό</button></form>
        <form action="deldata.php"><button class="block">Μ. Δεδομένα</button></form>
    </body>
</html>