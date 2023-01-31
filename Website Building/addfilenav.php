<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Select File Page</title>
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

        <h3>Προσθήκη Αρχείου</h3>
        <h1>
            Παρακαλώ επιλέξτε ποιού αρχείου τα δεδομένα θέλετε να προσθέσετε στη βάση.
        </h1>
        <div class="menuTitle">ΔΙΑΘΕΣΙΜΑ ΑΡΧΕΙΑ</div>
        <form action="addfilefires.php"><button class="block">fire_data.csv</button></form>
        <form action="addfilelocations.php"><button class="block">locations_data.csv</button></form>
        <form action="addfilestations.php"><button class="block">stations_list.csv</button></form>
        <form action="addfiledata.php"><button class="block">meteo_data.csv</button></form>
    </body>
</html>