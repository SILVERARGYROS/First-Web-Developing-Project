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
        <?php include 'topbar.php'?>

        <h3>Αρχική Σελίδα</h3>
        <h1>
            Καλωσήρθατε στην ιστοσελίδα διαχείρησης βάσης δεδομένων db1u10.<br>
            Εδώ μπορείτε να προβάλετε και να επεξεργαστείτε τα δεδομένα της βάσης.<br>
        </h1>

        <div class="menuTitle">ΔΙΑΘΕΣΙΜΕΣ ΕΠΙΛΟΓΕΣ</div>
        <form action="viewnav.php"><button class="block">Προβολή δεδομένων</button></form>
        <form action="addnav.php"><button class="block">Προσθήκη δεδομένων</button></form>
        <form action="delnav.php"><button class="block">Διαγραφή δεδομένων</button></form>
        <form action="addfilenav.php"><button class="block">Προσθήκη δεδομένων ενός αρχείου</button></form>
        <form action="addallfiles.php"><button class="block">Προσθήκη δεδομένων όλων των αρχείων</button></form>
        <form action="settings.php"><button class="block">Ρυθμίσεις βάσης δεδομένων</button></form>
        <form action="questions.php"><button class="block">Ζητούμενα Ερωτήματα</button></form>
    </body>
</html>