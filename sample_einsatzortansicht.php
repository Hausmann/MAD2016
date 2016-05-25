<html>
    <head>
        <link rel="stylesheet" href="./css/sample_einsatzortansicht.css" />
        <link rel="stylesheet" href="./css/style_flex.css" />
        <title>Einsatzortansicht</title>
    </head>
    <body>
        <header>
            <div id="logo"><a href="index.html"><img src="img/Datev_Logo.png"/></a></div>
            <div id="userID">
                <div id="infoText">Angemeldet als: </div>Mustermann, Max
            </div>
            <nav>
                <div class="menuButtonFirst"><a href="index.html">Startseite</a></div>
                <div class="menuButton"><a href="Azubi-Liste.html">Azubi-Liste</a></div>
                <div class="menuButton"><a href="newEinsatzort.html">Einsatzort</a></div>
                <div class="menuButton"><a href="newEinsatz.html">Einsatz</a></div>
                <div class="menuButton"><div class="active"><a href="sample_einsatzortansicht.html">Einsatzortansicht</a></div></div>
                <div class="menuButton"><a href="AusbilderGesamt_graphicview.php">Ausbilder</a></div>
            </nav>
        </header>
        <div id="shadow">
            <main>
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                <h1>Einsatzortansicht</h1>
                <content>
                    <!-- Needs Refactoring. Dringend.. Datenbank läuft noch auf localhost. Wers ändern will, muss schon mit Strg + F danach suchen!  -->
                    <!-- Navigation -->
                    <?php
                        $monthNames = array(
                            "January",
                            "February",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                            "August",
                            "September",
                            "October",
                            "November",
                            "December",);

                        // Form, um Fachausbilder und Jahr zu wählen.
                        echo "<p><form action=\"sample_einsatzortansicht.php\" method=\"post\">";

                            $personalnummer = "06105";
                            if(isset($_POST['personummer']))
                            {
                                $personalnummer = $_POST['personummer'];
                            }

                            echo "<input type=\"text\" name=\"personummer\" value=\"".$personalnummer."\" />";

                            $anfang = 2016;
                            $ende = date('Y') + 3;

                            $currentyear = date('Y');

                            if(isset($_POST['year']))
                            {
                                $currentyear = $_POST['year'];
                            }

                            echo "<select name=\"year\" onchange=\"this.form.submit()\" >";

                            for($i = $anfang; $i <= $ende; $i++)
                            {
                                echo "<option";
                                if ($i == $currentyear)
                                {
                                    echo " selected ";
                                }
                                echo ">$i</option>";
                            }

                            echo "</select>
                            </form></p>";

                    ?>

                    <!-- Einsatzortansicht -->
                    <table>
                        <!-- <tr>
                            <th>Woche</th>
                            <th>Anzahl</th>
                            <th>Marco Fuchs</th>
                            <th>Max Mustermann</th>
                            <th>Anton Hammerpfichel</th>
                        </tr> -->
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

                            $weekdays = array("Mo","Di","Mi","Do","Fr");

                            $dblink = mysqli_connect("localhost", "root", "", "einsatzplanungdb");

                            if(!$dblink)
                            {
                                die("Connection-Error: " . mysqli_connect_errno());
                            }

                            $query = "SELECT eins.`nachname`, eins.`vorname`, eins.`datumVon`, eins.`datumBis`, eins.`azubiID`, eins.`abteilungID`, `abteilungen`.`koe`, `abteilungen`.`anzMaxStellen`,                             `abteilungen`.`aBeauftragterID`, `personen`.`personalnummer`
                                    FROM (SELECT p.`nachname`, p.`vorname`, a.`azubiID`, e.`datumVon`, e.`datumBis`, e.`abteilungID` FROM `einsaetze` AS e JOIN `azubis` AS a ON e.`azubiID` = a.`azubiID` JOIN `personen` as p ON p.`personID` = a.`personID`) AS eins
                                    JOIN `abteilungen` ON eins.`abteilungID` = `abteilungen`.`abteilungID`
                                    JOIN `azubis`
                                    JOIN `personen` ON `azubis`.`azubiID` = eins.`azubiID` AND `personen`.`personalnummer` = $personalnummer AND `abteilungen`.`aBeauftragterID` = `personen`.`personID`
                                    WHERE ((eins.datumVon <= '$currentyear-1-1') AND (eins.datumBis >= '$currentyear-12-31')) OR ((eins.datumVon <= '$currentyear-1-1') AND (eins.datumBis >= '$currentyear-1-1')) OR ((eins.datumVon <= '$currentyear-12-31') AND (eins.datumBis >= '$currentyear-12-31')) OR ((eins.datumVon >= '$currentyear-1-1') AND (eins.datumBis <= '$currentyear-12-31'))
                                    ORDER BY `datumVon` ASC";
                            // echo $query;
                            $result = mysqli_query($dblink, $query);

                            // Aufbau des Einsätze-Arrays: Assoziatives Array
                            // als Schlüssel die AzubiNummer des jeweiligen Azubis
                            // als Wert ein Array mit folgendem Aufbau:
                            // [azubiId, nachname, vorname, einsatzAVon, einsatzABis, einsatzBVon, einsatzBBis, einsatzCVon, ...]
                            $einsaetze_nach_azubis = array();

                            while($row = mysqli_fetch_assoc($result))
                            {
                                $max_Einsatzzahl = (int)$row['anzMaxStellen'];

                                //echo "<br />";
                                //foreach ($row as $key => $value) {
                                    //echo "$key: $value";
                                    //echo "<br />";
                                //}
                                if(!array_key_exists($row['azubiID'], $einsaetze_nach_azubis))
                                {
                                    $einsaetze_nach_azubis[$row['azubiID']] = array($row['azubiID'], $row['nachname'], $row['vorname'], $row['datumVon'], $row['datumBis']);
                                }
                                else
                                {
                                    array_push($einsaetze_nach_azubis[$row['azubiID']], $row['datumVon'], $row['datumBis']);
                                }
                            }

                            //echo "<br />";
                           // foreach ($einsaetze_nach_azubis as $key => $value) {
                                //echo "$key: ";
                            //    foreach ($value as $val) {
                                    //echo "$val; ";
                               // }
                                //echo "<br />";
                           // }

                            // Wir opfern den im Array eh vorhandenen Key und schlüsseln das Array auf ganz normale Indizes um, dabei sortieren wir es nach dem ersten Einsatztag der Azubis im gewählten Zeitraum
                            usort($einsaetze_nach_azubis, "sort_einsaetze_nach_azubis_array");

                            //echo"<br />";
                            //foreach ($einsaetze_nach_azubis as $key => $value) {
                                //echo "$key: ";
                                //foreach ($value as $val) {
                                    //echo "$val; ";
                                //}
                                //echo"<br />";
                            //}

                            // (date("w", $timestamp) + 6) % 7
                            // January 2016
                            $dateVar = "31 Dec $currentyear";

                            $format = "j M Y";
                            $date = date_create_from_format($format, $dateVar);
                            $dateTmStmp = $date->getTimestamp();

                            $lastDayInYear = date("z", $dateTmStmp);

                            $dateVar = "1 Jan $currentyear";

                            $date = date_create_from_format($format, $dateVar);
                            $dateTmStmp = $date->getTimestamp();
                            $firstDayInt = date("N", $dateTmStmp);

                            // Auf 0 bringen, damit man damit rechnen kann.
                            $dayTypeOffSet = $firstDayInt - 1;

                            echo "<tr><th>Woche</th><th>Anzahl</th>";
                            foreach ($einsaetze_nach_azubis as $azubi)
                            {
                                echo "<th>$azubi[1], $azubi[2]</th>";
                            }

                            echo "</tr>";

                            $darkerBackColor = true;

                            for($i = 0; $i <= $lastDayInYear; $i++)
                            {
                                $iterationDate = date_create_from_format('z Y', "$i $currentyear");

                                $weekCell = "";
                                $dayType = ($i + $dayTypeOffSet) % 7;
                                // Samstag oder Sonntag nicht ausgeben
                                if($dayType == 5 || $dayType == 6)
                                {
                                    continue;
                                }
                                else if ($dayType == 0 || $i == 0)
                                {
                                    // Vorerst auf true, bis ich mir die Bedingung überlegt habe.
                                    if ($darkerBackColor)
                                    {
                                        $class = "gerade_KW";
                                    }
                                    else
                                    {
                                        $class = "ungerade_KW";
                                    }
                                    $darkerBackColor = !$darkerBackColor;

                                    $weekOffset = 4;

                                    if ($i == 0 && $dayTypeOffSet != 0)
                                    {
                                        //echo "hallo";
                                        $rowspan = 5 - $dayTypeOffSet;
                                        $weekOffset -= $dayTypeOffSet;
                                    }
                                    else if($lastDayInYear - $i < 5)
                                    {
                                        $rowspan = $lastDayInYear - $i + 1;
                                        $weekOffset = $lastDayInYear - $i;
                                    }
                                    else
                                    {
                                        $rowspan = 5;
                                    }

                                    $firstDayOfWeek = date_create_from_format('Y z', "$currentyear" . $i);
                                    $lastDayOfWeek = date_create_from_format('Y z', "$currentyear" . ($i + $rowspan - 1));

                                    $format = "d.m.Y";
                                    $weekCell = "<td rowspan=\"$rowspan\" class=\"$class\">". date_format($firstDayOfWeek, $format) ." - " . date_format($lastDayOfWeek, $format)." (KW ".  date_format($firstDayOfWeek, "W") .")</td>";

                                    if(date_format($firstDayOfWeek, "W") % 10 == 9 && $i != 0)
                                    {
                                        echo "<tr><th>Woche</th><th>Anzahl</th>";
                                        foreach ($einsaetze_nach_azubis as $azubi)
                                        {
                                            echo "<th>$azubi[1], $azubi[2]</th>";
                                        }
                                    }

                                    echo "<tr class=\"Wochenstart\">$weekCell";
                                }

                                // Azubi-Belegung anzeigen.

                                $einsaetze_anzahl = 0;

                                foreach($einsaetze_nach_azubis as $az)
                                {
                                    if (dateLiesInIntervalArr($iterationDate, $az))
                                    {
                                        $einsaetze_anzahl++;
                                    }
                                }
                                echo "<td class=\"";

                                if($einsaetze_anzahl < $max_Einsatzzahl - 1 || $einsaetze_anzahl == 0)
                                {
                                   echo "frei";
                                }
                                else if($einsaetze_anzahl == $max_Einsatzzahl - 1)
                                {
                                   echo "einer_frei";
                                }
                                else
                                {
                                   echo "voll";
                                }

                                echo "\">$einsaetze_anzahl</td>";

                                foreach($einsaetze_nach_azubis as $az)
                                {
                                    if (dateLiesInIntervalArr($iterationDate, $az))
                                    {
                                        echo "<td class=\"Anwesend\">";
                                    }
                                    else
                                    {
                                        echo "<td class=\"Abwesend\">";
                                    }
                                    echo "$weekdays[$dayType]</td>";
                                }

                                echo "</tr>";
                            }

                        function dateLiesInIntervalArr($date, $intervalArr)
                        {
                            for ($i = 3; $i < count($intervalArr); $i++)
                            {
                                $compareDate = date_create_from_format('Y-m-j', $intervalArr[$i]);

                                if ($date < $compareDate && $i%2 == 1)
                                {
                                    return false;
                                }
                                else if ($date <= $compareDate && $i%2 == 0)
                                {
                                    return true;
                                }
                            }

                            return false;
                        }
                        ?>
                        <!-- <tr class="Wochenstart">
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
                        </tr> -->
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
