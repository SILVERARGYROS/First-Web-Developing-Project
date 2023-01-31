<!DOCTYPE html>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
        <meta name="author" content="Argyros Konstantinos">
        <meta name="author" content="Thanasa Eleni">
        <title>db1u10 Login Page</title>
    </head>
    <body>
        <h1 style="color:white;text-align:left;">
            <br><br>
            Σελίδα Εισόδου<br><br>
            Παρακαλώ εισάγετε τα σωστά στοιχεία για να αποκτήσετε<br>
            πρόσβαση στη σελίδα διαχείρισης της βάσης db1u10<br><br>
            
        <form action= "<?php $_PHP_SELF ?>" method="GET">
            Username:<input type="text" name="username"><br><br>
            Password:<input type="password" name="password"><br>
            <input type="submit" name="submit">
        </form>
        </h1>
        <p style='color: red'> 
        <?php
            if(isset($_GET["submit"]))
            {
                $usernameInput = $_GET['username'];
                $passwordInput = $_GET['password'];

                if($usernameInput and $passwordInput)
                {
                    if ($usernameInput == 'db1u10' && $passwordInput == 'ilphp') 
                    {
                        header('Location: homePage.php');
                        exit;
                    }
                    else
                    {
                        echo "Αυτά δεν είναι τα σωστά στοιχεία!\nΠαρακαλώ ξαναπροσπαθήστε.\n";
                        echo "\nDEBUG you typed ", $usernameInput, " and ", $passwordInput;
                    }
                }
                else
                {
                    echo "Παρακαλώ πολύ εισάγετε τα στοιχεία πρώτα.\n";
                }
            }
        ?>
        </p>
    </body>
</html>