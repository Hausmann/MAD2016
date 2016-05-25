<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css" />
        <title>Neuen Einsatzort erstellen</title>
    </head>
    <body>
        <?php include "PHP\includes.php"; ?>
        <header>
            <div id="logo"><a href="index.html"><img src="img/Datev_Logo.png"/></a></div>
            <div id="userID">
                Angemeldet als: Mustermann, Max
            </div>
            <nav>
                <div class="menuButtonFirst"><a href="index.html">Startseite</a></div>
                <div class="menuButton"><a href="Azubi-Liste.html">Azubi-Liste</a></div>
                <div class="menuButton"><div class="active"><a href="newEinsatzort.html">Einsatzort</a></div></div>
                <div class="menuButton"><a href="newEinsatz.html">Einsatz</a></div>
                <div class="menuButton"><a href="sample_einsatzortansicht.html">Einsatzortansicht</a></div>
                <div class="menuButton"><a href="AusbilderGesamt_graphicview.php">Ausbilder</a></div>
            </nav>
        </header>
        <div id="shadow">
            <main>
                <h1>Einsatzort erstellt</h1>
                <?php

                    if (filter_input(INPUT_POST, 'koe') != null
                        && filter_input(INPUT_POST, 'beauftragter') != null
                        && filter_input(INPUT_POST, 'stellen') != null
                        && filter_input(INPUT_POST, 'beschreibung') != null)
                    {
                        $insertQuery = 'INSERT INTO abteilungen (koe, aBeauftragterID, anzMaxStellen, beschreibung) VALUES ("'
                            . filter_input(INPUT_POST, 'koe') . '", '
                            . filter_input(INPUT_POST, 'beauftragter') . ', '
                            . filter_input(INPUT_POST, 'stellen') . ', "'
                            . filter_input(INPUT_POST, 'beschreibung') . '")';

                        if (insertInto("192.168.1.143", "root", "", "einsatzplanungdb", $insertQuery))
                        {
                            echo "Einsatzort erfolgreich erstellt";
                        }
                        else
                        {
                            echo "Fehlgeschlagen";
                        }
                    }
                ?>

            </main>
            <footer>
                Footer
            </footer>
        </div>
    </body>
</html>
