<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/azubi_list.css"/>
        <meta charset="utf-8" />
        <title>AzubiListe</title>
    </head>
    <body>
        <h1>Azubiliste:</h1>
        <?php
            include "includes.php";

            $queryall = "SELECT vorname, nachname, personalnummer FROM personen
                         WHERE personen.rolleID = 3";
            dbquery("192.168.1.143", "root", "", "einsatzplanungdb", $queryall);
        ?>
            <form action="azubilistefiltern.php" method="post">
            <p> Filtern nach: </p>
            <p>Vorname : <input type="text" name="vorname" /></p>
            <p>Nachname : <input type="text" name="nachname" /></p>
            <p><input type="submit" /></p>
            </form>
           <?php $filtervorname = $_POST['vorname'];?>
           <?php $filternachname = $_POST['nachname'];?>


        <?php

            if($filtervorname != "" or $filternachname != "")
            {
                if($filtervorname != "" and $filternachname !="")
                {
                $query = "SELECT vorname, nachname, personalnummer FROM personen
                          WHERE personen.vorname = '$filtervorname'
                          AND personen.nachname = '$filternachname'
                          AND personen.rolleID = 3 ";

                }
                else
                {
                $query = "SELECT vorname, nachname, personalnummer FROM personen
                          WHERE personen.rolleID = '3'
                          AND personen.vorname = '$filtervorname'
                          OR personen.nachname = '$filternachname'
                           ";
                }

                dbquery("192.168.1.143", "root", "", "einsatzplanungdb", $query);
            }

        ?>
    </body>
</html>
