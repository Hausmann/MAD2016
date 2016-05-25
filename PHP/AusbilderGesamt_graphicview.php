<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AusbilderGesamt</title>
        <link rel="stylesheet" href="css/AusbilderGesamt_graphicview.css"/>
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png" />
    </head>

    <body>
        <header>
            <div id="logo"><a href="index.html"><img src="img/Datev_Logo.png"/></a></div>
            <div id="userID">
                Angemeldet als: Mustermann, Max
            </div>
            <nav>
                <div class="menuButtonFirst"><a href="index.html">Startseite</a></div>
                <div class="menuButton"><a href="Azubi-Liste.html">Azubi-Liste</a></div>
                <div class="menuButton"><a href="newEinsatzort.html">Einsatzort</a></div>
                <div class="menuButton"><a href="newEinsatz.html">Einsatz</a></div>
                <div class="menuButton"><a href="sample_einsatzortansicht.html">Einsatzortansicht</a></div>
                <div class="menuButton"><div class="active"><a href="AusbilderGesamt_graphicview.html">Ausbilder</a></div></div>
            </nav>
        </header>

        <div id="shadow">
		<main>
			<p>Inhaltsbereich</p>
            <?php
                $db_link = mysqli_connect ("localhost:81", "root", "", "einsatzplanungdb");

                if (!$db_link)
                {
                    die ('Connect Error:' .mysqli_connect_errno());
                }

                //Datenbakquery
                $str_query = "SELECT p.vorname, p.nachname, koe.koe, e.datumVon, e.datumBis FROM personen AS p
                                    JOIN azubis AS a
                                    ON a.personID = p.personID
                                    JOIN einsaetze AS e
                                    ON e.azubiID = a.azubiID
                                    JOIN abteilungen AS koe
                                    ON koe.abteilungID = e.abteilungID";

                //Datenbankabfrage
                $result = mysqli_query($db_link, $str_query);

                $startkw = 1;
                $abteilung = "Berufsschule";

                $test_datum = '2004-07-01';
                $wochentage = array ('So','Mo','Di','Mi','Do','Fr','Sa');
                list ($jahr, $monat, $tag) = split ('[-]', $test_datum) ;
                $datum = getdate(mktime ( 0,0,0, $monat, $tag, $jahr));
                $wochentag = $datum['wday'];
                echo "<p>$wochentage[$wochentag]</p>";

                echo "<table>
                        <tr>
                            <th style='width:16vw'>KW</th>";
                for ($startkw; $startkw <= $startkw + 11; $startkw++)
                {
                    echo "<th style='width:7vw'>$startkw</th>";
                }
                echo "</tr>";
                echo "<tr>";

                switch ($abteilung)
                {
                    case 'Berufsschule':
                        echo "<td class='berufsschule'> </td>";
                }

                echo "</tr>";
                echo "</table>";
            ?>


		</main>
        <footer>
            Fußbereich
        </footer>
        </div>
    </body>
</html>
