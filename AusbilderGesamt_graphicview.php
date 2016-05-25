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
                <div id="infoText">Angemeldet als: </div>Mustermann, Max
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
		<div id ="main">
			<p>Inhaltsbereich</p>


            <?php
                $db_link = mysqli_connect ("192.168.1.143", "root", "", "einsatzplanungdb");

                if (!$db_link)
                {
                    die ('Connect Error:' .mysqli_connect_errno());
                }


                $str_query = "SELECT vorname, nachname FROM azubis";

                $result = mysqli_query($db_link, $str_query);

                $startkw = 10;
                $endkw = $startkw + 11;
                $abteilung = "Berufsschule";

                echo "<table>
                        <tr>
                            <th style='width:16vw'>KW</th>";
                for ($startkw; $startkw <= $endkw; $startkw++)
                {
                    echo "<th style='width:7vw'>$startkw</th>";
                }
                echo "</tr>";

                $row = mysqli_fetch_assoc($result);

                while ($row)
                {
                    echo "<tr>";
                    echo "<td>" . $row["vorname"] . $row["nachname"] . "</td>";
                    echo "</tr>";
                }


                echo "</table>";

            ?>


            <table>
                <tr>
                    <th style="width:16vw">KW</th>
                    <th style="width:7vw">10</th>
                    <th style="width:7vw">11</th>
                    <th style="width:7vw">12</th>
                    <th style="width:7vw">13</th>
                    <th style="width:7vw">14</th>
                    <th style="width:7vw">15</th>
                    <th style="width:7vw">16</th>
                    <th style="width:7vw">17</th>
                    <th style="width:7vw">18</th>
                    <th style="width:7vw">19</th>
                    <th style="width:7vw">20</th>
                    <th style="width:7vw">21</th>
                </tr>
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
        <footer>
            Fußbereich
        </footer>
        </div>
    </body>
</html>
