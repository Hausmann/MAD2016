<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>PHP Querys</title>
    </head>
    <body>
        <h1>PHP Querys:</h1>
        <?php
            include "includes.php";

            //Alle Informationen aus der Tabelle Personen entnehmen
            dbquery("192.168.1.143", "root", "", "einsatzplanungdb", "SELECT * FROM personen");

            //Alle Personen mit Rollenbezeichnung auswählen
            $query1 = "SELECT p.nachname, p.vorname, p.personalnummer, r.bezeichnung FROM personen as p
                        INNER JOIN rollen as r
                        ON p.rolleID = r.rolleID";
            dbquery("192.168.1.143", "root", "", "einsatzplanungdb", $query1);

            //Alle Azubis mit Ausbildungsberuf auswählen
            $query2 = "SELECT p.nachname, p.vorname, p.personalnummer, r.bezeichnung, b.bezeichnung FROM azubis as a
                        INNER JOIN personen as p
                        ON a.personID = p.personID

                        INNER JOIN rollen as r
                        ON p.rolleID = r.rolleID

                        INNER JOIN berufe as b
                        ON b.BerufID = a.aBerufID";
            dbquery("192.168.1.143", "root", "", "einsatzplanungdb", $query2);

            //Alle Azubis mit Ausbildungsberuf auswählen
            $query3 = "SELECT p.nachname, p.vorname, p.personalnummer,  b.bezeichnung, k.koe, e.datumVon, e.datumBis FROM azubis as a
                        INNER JOIN personen as p
                        ON a.personID = p.personID

                        INNER JOIN einsaetze as e
                        ON e.azubiID = a.azubiID

                        INNER JOIN berufe as b
                        ON b.BerufID = a.aBerufID

                        INNER JOIN abteilungen as k
                        ON e.abteilungID = k.abteilungID";
            dbquery("192.168.1.143", "root", "", "einsatzplanungdb", $query3);
        ?>
    </body>
</html>
