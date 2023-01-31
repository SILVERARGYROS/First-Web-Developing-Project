<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Q12 Page</title>
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

        <h3>Ερώτημα Q12:<br>
        Παρουσιάστε τα στοιχεία των δασικών πυρκαγιών που εκδηλώθηκαν στο ορθογώνιο που
        ορίζεται από τις συντεταγμένες της πόλης X και συντεταγμένες της πόλης Y, με φθίνουσα
        σειρά βάσει των καμμένων δασικών εκτάσεων.</h3>

        <h1>Παρακαλώ εισάγεται γεωγραγικό πλάτος και μήκος Χ
            και γεωγραφικό πλάτος και μήκος Υ:<br><br>
            <form action = "<?php $_PHP_SELF ?>" method = "GET">
                πλάτος Χ:<input type="number" step=any name="πλάτος1"></input><br>
                μήκος Χ: <input type="number" step=any name="μήκος1"></input><br>
                πλάτος Υ:<input type="number" step=any name="πλάτος2"></input><br>
                μήκος Υ: <input type="number" step=any name="μήκος2"></input><br>
                <input type="submit" value="Υποβολή" name="submit"></input>
            </form>
        </h1>
        <h3>Αποτέλεσμα:</h3>
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['πλάτος1'];
                $a2 = $_GET['μήκος1'];
                $a3 = $_GET['πλάτος2'];
                $a4 = $_GET['μήκος2'];
                if($a1 and $a2 and $a3 and $a4)
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                        or die ("Αποτυχία Σύνδεσης\n");
    
                    $result = pg_query($link, "SELECT  Δασικές_Πυρκαγιές.*  
                    FROM    Δασικές_Πυρκαγιές, Δήμοι, ΕΚΔΗΛΩΘΗΚΑΝ
                    WHERE   ΕΚΔΗΛΩΘΗΚΑΝ.idΔήμοι = Δήμοι.id
                    AND     ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ = Δασικές_Πυρκαγιές.id
                    AND     ((Δήμοι.γεωγ_πλάτος >= $a1
                    AND     Δήμοι.γεωγ_πλάτος <= $a3)
                    OR      (Δήμοι.γεωγ_πλάτος <= $a1
                    AND     Δήμοι.γεωγ_πλάτος >= $a3))
                    AND     ((Δήμοι.γεωγ_μήκος >= $a2
                    AND     Δήμοι.γεωγ_μήκος <= $a4)
                    OR      (Δήμοι.γεωγ_μήκος <= $a2
                    AND     Δήμοι.γεωγ_μήκος >= $a4))
                    ORDER BY Δασικές_Πυρκαγιές.καμμένη_έκταση DESC;")
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
                    $a1 = $_GET['πλάτος1'];
                    $a2 = $_GET['μήκος1'];
                    $a3 = $_GET['πλάτος2'];
                    $a4 = $_GET['μήκος2'];
                    if($a1 and $a2 and $a3 and $a4)
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