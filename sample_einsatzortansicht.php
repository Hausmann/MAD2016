<html>
    <head>
        <link rel="stylesheet" href="./css/sample_einsatzortansicht.css" />
        <link rel="stylesheet" href="./css/style.css" />
        <title>Einsatzortansicht</title>
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
                <div class="menuButton"><div class="active"><a href="sample_einsatzortansicht.html">Einsatzortansicht</a></div></div>
            </nav>
        </header>
        <div id="shadow">
            <main>
                <h1>Einsatzortansicht</h1>
                <content>
                    <!-- Alles außerhalb des Contents ist nicht mein Bier, sondern das des Layouts -->
                    <!-- Navigation -->
                    <form action="sample_einsatzortansicht.php" method="post">
                        <button name="letzter_Monat" >&lt;</button>
                        <select name="monat">
                            <option>November 2015</option>
                            <option>Dezember 2015</option>
                            <option selected>Januar 2016</option>
                            <option>Februar 2016</option>
                            <option>März 2016</option>
                        </select>
                        <button type="button" name="naechster_Monat" >&gt;</button>
                    </form>

                    <!-- Einsatzortansicht -->
                    <table>
                        <tr>
                            <th>Woche</th>
                            <th>Anzahl</th>
                            <th>Marco Fuchs</th>
                            <th>Max Mustermann</th>
                            <th>Anton Hammerpfichel</th>
                        </tr>
                        <?php
                            function sort_einsaetze_nach_azubis_array($first, $second)
                            {
                                if($first[2] < $second[2])
                                {
                                    return -1;
                                }
                                else if($first[2] > $second[2])
                                {
                                    return 1;
                                }

                                return 0;
                            }

                            $dblink = mysqli_connect("localhost", "root", "", "einsatzplanungdb");

                            if(!$dblink)
                            {
                                die("Connection-Error: " . mysqli_connect_errno());
                            }

                            $query = "SELECT eins.`nachname`, eins.`vorname`, eins.`datumVon`, eins.`datumBis`, eins.`azubiID`, eins.`abteilungID`, `abteilungen`.`koe`, `abteilungen`.`aBeauftragterID`,                           `personen`.`personalnummer`
                                    FROM (SELECT p.`nachname`, p.`vorname`, e.`datumVon`, a.`azubiID`, e.`datumBis`, e.`abteilungID` FROM `einsaetze` AS e JOIN `azubis` AS a ON e.`azubiID` = a.`azubiID` JOIN `personen` as p ON p.`personID` = a.`personID`) AS eins
                                    JOIN `abteilungen` ON eins.`abteilungID` = `abteilungen`.`abteilungID`
                                    JOIN `azubis`
                                    JOIN `personen` ON `azubis`.`azubiID` = eins.`azubiID` AND `personen`.`personalnummer` = 06105 AND `abteilungen`.`aBeauftragterID` = `personen`.`personID`
                                    WHERE ((eins.datumVon <= '2014-1-1') AND (eins.datumBis >= '2016-1-31')) OR ((eins.datumVon <= '2014-1-1') AND (eins.datumBis >= '2014-1-1')) OR ((eins.datumVon <= '2016-1-31') AND (eins.datumBis >= '2016-1-31')) OR ((eins.datumVon >= '2014-1-1') AND (eins.datumBis <= '2016-1-31'))
                                    ORDER BY `datumVon` ASC";
                            echo $query;
                            $result = mysqli_query($dblink, $query);

                            // Aufbau des Einsätze-Arrays: Assoziatives Array
                            // als Schlüssel die AzubiNummer des jeweiligen Azubis
                            // als Wert ein Array mit folgendem Aufbau:
                            // [azubiId, nachname, vorname, einsatzAVon, einsatzABis, einsatzBVon, einsatzBBis, einsatzCVon, ...]
                            $einsaetze_nach_azubis = array();

                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo"<br />";
                                foreach ($row as $key => $value) {
                                    echo "$key: $value";
                                    echo"<br />";
                                }
                                if(!array_key_exists($row['azubiID'], $einsaetze_nach_azubis))
                                {
                                    $einsaetze_nach_azubis[$row['azubiID']] = array($row['azubiID'], $row['nachname'], $row['vorname'], $row['datumVon'], $row['datumBis']);
                                }
                                else
                                {
                                    array_push($einsaetze_nach_azubis[$row['azubiID']], $row['datumVon'], $row['datumBis']);
                                }
                            }

                            echo"<br />";
                            foreach ($einsaetze_nach_azubis as $key => $value) {
                                echo "$key: ";
                                foreach ($value as $val) {
                                    echo "$val; ";
                                }
                                echo"<br />";
                            }

                            // Wir opfern den im Array eh vorhandenen Key und schlüsseln das Array auf ganz normale Indizes um, dabei sortieren wir es nach dem ersten Einsatztag der Azubis im gewählten Zeitraum
                            usort($einsaetze_nach_azubis, "sort_einsaetze_nach_azubis_array");

                            echo"<br />";
                            foreach ($einsaetze_nach_azubis as $key => $value) {
                                echo "$key: ";
                                foreach ($value as $val) {
                                    echo "$val; ";
                                }
                                echo"<br />";
                            }

                            // (date("w", $timestamp) + 6) % 7
                            // January 2016
                            $dateVar = "1 " . "January 2016";

                            $date = date_create_from_format("j M Y", $dateVar);
                            echo "hallo";
                            echo getDate(date_timestamp_get($date))["weekday"];
                            echo date_format($date, "j M Y");
                            echo "hallo";
                        ?>
                        <tr class="Wochenstart">
                            <td rowspan="5" class="ungerade_KW">01.01.2016 - 05.01.2016 (KW 1)</td>
                            <td class="frei">1</td>
                            <td class="Anwesend">Mo</td>
                            <td class="Abwesend">Mo</td>
                            <td class="Abwesend">Mo</td>
                        </tr>
                        <tr>
                            <td class="frei">1</td>
                            <td class="Anwesend">Di</td>
                            <td class="Abwesend">Di</td>
                            <td class="Abwesend">Di</td>
                        </tr>
                        <tr>
                            <td class="frei">1</td>
                            <td class="Anwesend">Mi</td>
                            <td class="Abwesend">Mi</td>
                            <td class="Abwesend">Mi</td>
                        </tr>
                        <tr>
                            <td class="frei">1</td>
                            <td class="Anwesend">Do</td>
                            <td class="Abwesend">Do</td>
                            <td class="Abwesend">Do</td>
                        </tr>
                        <tr>
                            <td class="frei">1</td>
                            <td class="Anwesend">Fr</td>
                            <td class="Abwesend">Fr</td>
                            <td class="Abwesend">Fr</td>
                        </tr>
                        <tr class="Wochenstart Feiertag">
                            <td rowspan="5" class="gerade_KW">08.01.2016 - 12.01.2016 (KW 2)</td>
                            <td class="einer_frei">0</td>
                            <td class="Anwesend">Mo</td>
                            <td class="Anwesend">Mo</td>
                            <td class="Abwesend">Mo</td>
                        </tr>
                        <tr class="Feiertag">
                            <td class="einer_frei">0</td>
                            <td class="Anwesend">Di</td>
                            <td class="Anwesend">Di</td>
                            <td class="Abwesend">Di</td>
                        </tr>
                        <tr>
                            <td class="einer_frei">2</td>
                            <td class="Anwesend">Mi</td>
                            <td class="Anwesend">Mi</td>
                            <td class="Abwesend">Mi</td>
                        </tr>
                        <tr>
                            <td class="frei">1</td>
                            <td class="Anwesend">Do</td>
                            <td class="Schulung">Do</td>
                            <td class="Abwesend">Do</td>
                        </tr>
                        <tr>
                            <td class="frei">1</td>
                            <td class="Anwesend">Fr</td>
                            <td class="Schulung">Fr</td>
                            <td class="Abwesend">Fr</td>
                        </tr>
                        <tr class="Wochenstart">
                            <td rowspan="5" class="ungerade_KW">15.01.2016 - 19.01.2016 (KW 3)</td>
                            <td class="einer_frei">2</td>
                            <td class="Anwesend">Mo</td>
                            <td class="Anwesend">Mo</td>
                            <td class="Abwesend">Mo</td>
                        </tr>
                        <tr>
                            <td class="einer_frei">2</td>
                            <td class="Anwesend">Di</td>
                            <td class="Anwesend">Di</td>
                            <td class="Abwesend">Di</td>
                        </tr>
                        <tr>
                            <td class="einer_frei">2</td>
                            <td class="Anwesend">Mi</td>
                            <td class="Anwesend">Mi</td>
                            <td class="Abwesend">Mi</td>
                        </tr>
                        <tr>
                            <td class="voll">3</td>
                            <td class="Anwesend">Do</td>
                            <td class="Anwesend">Do</td>
                            <td class="Anwesend">Do</td>
                        </tr>
                        <tr>
                            <td class="voll">3</td>
                            <td class="Anwesend">Fr</td>
                            <td class="Anwesend">Fr</td>
                            <td class="Anwesend">Fr</td>
                        </tr>
                        <tr class="Wochenstart">
                            <td rowspan="5" class="gerade_KW">22.01.2016 - 26.01.2016 (KW 4)</td>
                            <td class="einer_frei">2</td>
                            <td class="Abwesend">Mo</td>
                            <td class="Anwesend">Mo</td>
                            <td class="Anwesend">Mo</td>
                        </tr>
                        <tr>
                            <td class="einer_frei">2</td>
                            <td class="Abwesend">Di</td>
                            <td class="Anwesend">Di</td>
                            <td class="Anwesend">Di</td>
                        </tr>
                        <tr>
                            <td class="einer_frei">2</td>
                            <td class="Abwesend">Mi</td>
                            <td class="Anwesend">Mi</td>
                            <td class="Anwesend">Mi</td>
                        </tr>
                        <tr>
                            <td class="einer_frei">2</td>
                            <td class="Abwesend">Do</td>
                            <td class="Anwesend">Do</td>
                            <td class="Anwesend">Do</td>
                        </tr>
                        <tr>
                            <td class="einer_frei">2</td>
                            <td class="Abwesend">Fr</td>
                            <td class="Anwesend">Fr</td>
                            <td class="Anwesend">Fr</td>
                        </tr>
                        <tr class="Wochenstart">
                            <td rowspan="5" class="ungerade_KW">29.01.2016 - 02.02.2016 (KW 5)</td>
                            <td class="einer_frei">2</td>
                            <td class="Abwesend">Mo</td>
                            <td class="Anwesend">Mo</td>
                            <td class="Anwesend">Mo</td>
                        </tr>
                        <tr>
                            <td class="einer_frei">2</td>
                            <td class="Abwesend">Di</td>
                            <td class="Anwesend">Di</td>
                            <td class="Anwesend">Di</td>
                        </tr>
                        <tr>
                            <td class="einer_frei">2</td>
                            <td class="Abwesend">Mi</td>
                            <td class="Anwesend">Mi</td>
                            <td class="Anwesend">Mi</td>
                        </tr>
                        <tr>
                            <td class="frei">1</td>
                            <td class="Abwesend">Do</td>
                            <td class="Abwesend">Do</td>
                            <td class="Anwesend">Do</td>
                        </tr>
                        <tr>
                            <td class="frei">1</td>
                            <td class="Abwesend">Fr</td>
                            <td class="Abwesend">Fr</td>
                            <td class="Anwesend">Fr</td>
                        </tr>
                    </table>
                    <h2>Funktionsweise:</h2>
                    <p> Diese Ansicht kann ein Fachausbilder einer gewissen Abteilung (z. B. EB999) aufrufen. Er sieht dort kompakt, wann welcher Azubi in seiner Abteilung ist und wie viele dort pro Tag sitzen.</p>
                    <h2>Farblegende: </h2>
                    <p><span class="Feiertag">Grau</span> hinterlegt: Feiertag / Arbeitsfrei</p>
                    <p><span class="Abwesend">Weiß</span> hinterlegt: Azubi ist nicht in Abt. eingesetzt</p>
                    <p><span class="Anwesend">Grün</span> hinterlegt: Azubi ist in Abteilung anwesend</p>
                    <p><span class="Schulung">Lila</span> hinterlegt: Azubi ist auf einer Schulung / Studium / BS (also in Abt. eingesetzt, aber nicht anwesend)</p>
                    <p><span class="einer_frei">Orange</span> hinterlegt: Nur noch ein Platz frei in der Abteilung</p>
                    <p><span class="voll">Rot</span> hinterlegt: Kein Platz mehr frei</p>
                </content>
            </main>
            <footer>
                Footer
            </footer>
        </div>
    </body>
    ☼</html>
