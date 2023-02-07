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
                Όνομα Πόλης Χ:<input type="text" step=any name="δ1"></input><br>
                Όνομα Πόλης Υ: <input type="text" step=any name="δ2"></input><br>
                <input type="submit" value="Υποβολή" name="submit"></input>
            </form>
        </h1>
        <h3>Αποτέλεσμα:</h3>
        <?php
            if(isset($_GET["submit"]))
            {
                $a1 = $_GET['δ1'];
                $a2 = $_GET['δ2'];
                if($a1 and $a2)
                {
                    $link = pg_connect("host=$host dbname=$db user=$user password=$pass") 
                        or die ("Αποτυχία Σύνδεσης\n");
    
                    $result = pg_query($link, "SELECT  Δασικές_Πυρκαγιές.*
                    FROM    Δασικές_Πυρκαγιές, Δήμοι δ1, Δήμοι δ2, Δήμοι δ3, ΕΚΔΗΛΩΘΗΚΑΝ
                    WHERE   ΕΚΔΗΛΩΘΗΚΑΝ.idΔήμοι = δ3.id
                    AND     ΕΚΔΗΛΩΘΗΚΑΝ.idΔΠ = Δασικές_Πυρκαγιές.id
                    AND     δ1.όνομα_Δήμου = '$a1'
                    AND     δ2.όνομα_Δήμου = '$a2'   
                    AND     (
                            --1<3<2 1<3<2
                            (δ1.γεωγ_πλάτος  <= δ3.γεωγ_πλάτος
                    AND     δ3.γεωγ_πλάτος  <= δ2.γεωγ_πλάτος
                    AND     δ1.γεωγ_μήκος  <= δ3.γεωγ_μήκος
                    AND     δ3.γεωγ_μήκος  <= δ2.γεωγ_μήκος)
                            --2<3<1 1<3<2
                    OR      (δ2.γεωγ_πλάτος  <= δ3.γεωγ_πλάτος
                    AND     δ3.γεωγ_πλάτος  <= δ1.γεωγ_πλάτος
                    AND     δ1.γεωγ_μήκος  <= δ3.γεωγ_μήκος
                    AND     δ3.γεωγ_μήκος  <= δ2.γεωγ_μήκος)
                            --2<3<1 2<3<1
                    OR      (δ2.γεωγ_πλάτος  <= δ3.γεωγ_πλάτος
                    AND     δ3.γεωγ_πλάτος  <= δ1.γεωγ_πλάτος
                    AND     δ2.γεωγ_μήκος  <= δ3.γεωγ_μήκος
                    AND     δ3.γεωγ_μήκος  <= δ1.γεωγ_μήκος)
                            --1<3<2 2<3<1
                    OR      (δ1.γεωγ_πλάτος  <= δ3.γεωγ_πλάτος
                    AND     δ3.γεωγ_πλάτος  <= δ2.γεωγ_πλάτος
                    AND     δ2.γεωγ_μήκος  <= δ3.γεωγ_μήκος
                    AND     δ3.γεωγ_μήκος  <= δ1.γεωγ_μήκος)
                    )
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
                    $a1 = $_GET['δ1'];
                    $a2 = $_GET['δ2'];
                    if($a1 and $a2)
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