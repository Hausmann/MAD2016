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
                $db_link = mysqli_connect ("192.168.1.143:81", "root", "", "einsatzplanungdb");

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

                echo "<tale>
                        <tr>
                            <th style='width:16vw'>KW</th>";
                for ($startkw; $startkw <= $startkw + 11; $startkw++)
                {
                    echo "<th style='width:7vw'>"$startkw"</th>";
                }

                echo "<tr>"

                switch $abteilung
                        "<td class='"">";


            ?>
                <tr>
                    <td>Azubi 1</td>
                    <td class="berufsschule"> </td>
                    <td class="berufsschule"> </td>
                    <td class="berufsschule"> </td>
                    <td class="berufsschule"> </td>
                    <td class="berufsschule"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                </tr>
                <tr>
                    <td>Azubi 2</td>
                    <td class="berufsschule"> </td>
                    <td class="berufsschule"> </td>
                    <td class="berufsschule"> </td>
                    <td class="berufsschule"> </td>
                    <td class="berufsschule"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="schulung"> </td>
                    <td class="schulung"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                </tr>
                <tr>
                    <td>Azubi 3</td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="schulung"> </td>
                    <td class="schulung"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                </tr>
                <tr>
                    <td>Azubi 4</td>
                    <td class="einsatz"> </td>
                    <td class="urlaub"> </td>
                    <td class="urlaub"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="einsatz"> </td>
                    <td class="schulung"> </td>
                    <td class="einsatz"> </td>
                </tr>
            </table>
            </div>
		</main>
        <footer>
            Fußbereich
        </footer>
        </div>
    </body>
</html>
