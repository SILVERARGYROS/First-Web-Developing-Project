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
                <a href="viewnav.php">View</a>
                <a href="addnav.php">Add Row</a>
                <a href="addfilenav.php">Add File</a>
                <a href="delnav.php">Erase Row</a>
                <a href="delfilenav.php">Erase File</a>
                <a href="arc.php">Architecture</a>
            </div>
        </div>
        <!--Topbar Navigation Code-->

        <h3>Add Row</h3>
        <h1>
            Please select in which table you want to add content to.
        </h1>
        <div class="menuTitle">AVAILABLE TABLES</div>
        <form action="addfires.php"><button class="block">Δασικές Πυρκαγιές</button></form>
        <form action="addlocations.php"><button class="block">Δήμοι</button></form>
        <form action="addstations.php"><button class="block">Μ. Σταθμοί</button></form>
        <form action="adddata.php"><button class="block">Μ. Δεδομένα</button></form>
    </body>
</html>