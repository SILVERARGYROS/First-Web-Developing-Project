<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>e-Nviromental Home Page</title>
    </head>

    <body>
        <!-- Topbar Navigation Code-->
        <div class="topnav">
            <a class="button" href="index.php">e-Nviromental</a>
            <div class="topnav-right">
                <a href="viewnav.php">View</a>
                <a href="addnav.php">Add Row</a>
                <a href="addnav.php">Add File</a>
                <a href="delnav.php">Erase Row</a>
                <a href="delnav.php">Erase File</a>
                <a href="arc.php">Architecture</a>
                
            </div>
        </div>
        <!-- Topbar Navigation Code-->

        <h3>Home Page</h3>
        <h1>
            Welcome to our official e-Nviromental database management website.
            Here you can view and manage all the information inside the database.<br>
        </h1>

        <div class="menuTitle">NAVIGATION MENU</div>
        <form action="viewnav.php"><button class="block">View content</button></form>
        <form action="addnav.php"><button class="block">Add content manually</button></form>
        <form action="addfilenav.php"><button class="block">Add content from file</button></form>
        <form action="delnav.php"><button class="block">Delete content manually</button></form>
        <form action="delfilenav.php"><button class="block">Erase content from file</button></form>
        <form action="cleardb.php"><button class="block">Clear Database</button></form>
        <form action="arc.php"><button class="block">Inspect table architecture</button></form>
    </body>