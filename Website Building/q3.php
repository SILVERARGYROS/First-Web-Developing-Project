<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Q3 Page</title>
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

        <h3>Ερώτημα Q3:<br>
        Εμφανίστε όλα τα δεδομένα των δασικών πυρκαγιών που εκδηλώθηκαν στον δήμο X, με φθίνουσα σειρά βάσει της καμμένης έκτασης σε στρέμματα.</h3>

        <h1>Παρακαλώ εισάγεται Δήμο Χ:<br><br>
            <form action = "<?php $_PHP_SELF ?>" method = "GET">
                Δήμος:<input type="text" name="Δήμος"></input><br>
                <input type="submit" value="Υποβολή" name="submit"></input>
            </form>
        </h1>
        <h3>Αποτέλεσμα:</h3>
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['Δήμος'];
                if($a1)
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                        or die ("Αποτυχία Σύνδεσης\n");
    
                    $result = pg_query($link, "SELECT  Δασικές_Πυρκαγιές.*
                    FROM    Δασικές_Πυρκαγιές, Δήμοι, ΕΚΔΗΛΩΘΗΚΑΝ
                    WHERE   ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ = Δασικές_Πυρκαγιές.id
                    AND     ΕΚΔΗΛΩΘΗΚΑΝ.idΔήμοι = Δήμοι.id
                    AND     Δήμοι.όνομα_Δήμου = '$a1'
                    ORDER BY    Δασικές_Πυρκαγιές.καμμένη_έκταση DESC;")
                    or die("Αποτυχία Προβολής\n");
    
                    $rows = pg_num_rows($result);
                }
                else
                {
                    echo "Παρακαλώ συμπληρώστε όλα τα πεδία!\n";
                }
            }
        ?>
        <table border="1">
            <tr>
                <th>id</th>
                <th>όνομα_πυρ_σώματος</th>
                <th>ημερομ_έναρξης</th>
                <th>ώρα_έναρξης</th>
                <th>ημερομ_κατασβ</th>
                <th>ώρα_κατασβ</th>
                <th>καμμένη_έκταση</th>
                <th>πλήθος_προσωπικού</th>
                <th>πλήθος_οχημάτων</th>
                <th>πλήθος_εναέριων_μέσων</th>
            </tr>
            <?php
                if(isset($_GET["submit"]))
                {
                    $a1 = $_GET['Δήμος'];
                    if($a1)
                    {
                        // Loop on rows in the result set.
                        for($ri = 0; $ri < $rows; $ri++) {
                            echo "<tr>\n";
                            $row = pg_fetch_array($result, $ri);
                            echo "<td>", $row["id"], "</td>
                            <td>", $row["όνομα_πυρ_σώματος"], "</td>	
                            <td>", $row["ημερομ_έναρξης"], "</td>	
                            <td>", $row["ώρα_έναρξης"], "</td>	
                            <td>", $row["ημερομ_κατασβ"], "</td>	
                            <td>", $row["ώρα_κατασβ"], "</td>	
                            <td>", $row["καμμένη_έκταση"], "</td>	
                            <td>", $row["πλήθος_προσωπικού"], "</td>	
                            <td>", $row["πλήθος_οχημάτων"], "</td>	
                            <td>", $row["πλήθος_εναέριων_μέσων"], "</td>	
                            </tr>
                            ";
                        }
                        pg_close($link);
                    }
                }
            ?>
    </table>
       
    </body>
</html>