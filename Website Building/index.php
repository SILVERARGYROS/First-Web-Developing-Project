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

        <h3>Αρχική Σελίδα</h3>
        <h1>
            Καλωσήρθατε στην ιστοσελίδα διαχείρησης βάσης δεδομένων db1u10.<br>
            Εδώ μπορείτε να προβάλετε και να επεξεργαστείτε τα δεδομένα της βάσης.<br>
        </h1>

        <div class="menuTitle">ΔΙΑΘΕΣΙΜΕΣ ΕΠΙΛΟΓΕΣ</div>
        <form action="viewnav.php"><button class="block">Προβολή δεδομένων</button></form>
        <form action="addnav.php"><button class="block">Προσθήκη δεδομένων</button></form>
        <form action="addfilenav.php"><button class="block">Προσθήκη δεδομένων από αρχείο</button></form>
        <form action="delnav.php"><button class="block">Διαγραφή δεδομένων</button></form>
        <form action="settings.php"><button class="block">Ρυθμίσεις βάσης δεδομένων</button></form>
    </body>
</html>