<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style_flex.css" />
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png" />
        <title>Neuen Einsatzort erstellen</title>
    </head>
    <body>
        <?php include "PHP\includes.php"; ?>
        <header>
            <div id="logo"><a href="index.html"><img src="img/Datev_Logo.png"/></a></div>
            <div id="userID">
                <div id="infoText">Angemeldet als: </div>Mustermann, Max
            </div>
            <nav>
                <div class="menuButtonFirst"><a href="index.html">Startseite</a></div>
                <div class="menuButton"><a href="Azubi-Liste.html">Azubi-Liste</a></div>
                <div class="menuButton"><div class="active"><a href="newEinsatzort.html">Einsatzort</a></div></div>
                <div class="menuButton"><a href="newEinsatz.html">Einsatz</a></div>
                <div class="menuButton"><a href="sample_einsatzortansicht.html">Einsatzortansicht</a></div>
                <div class="menuButton"><a href="AusbilderGesamt_graphicview.html">Ausbilder</a></div>
            </nav>
        </header>
        <div id="shadow">
            <div id ="main">
                <h1>Neuen Einsatzort erstellen</h1>
                <form action="createEinsatzort.php" method="post">
                    <p>KOE: <input type="text" name="koe" /></p>
                    <p>Beauftragter:
                        <select name="beauftragter">
                            <?php dbqueryReturnOption("192.168.1.143", "root", "", "einsatzplanungdb", "SELECT personID, Nachname, Vorname FROM personen WHERE rolleID = 2"); ?>
                        </select>
                    </p>
                    <p>Max Stellen: <input type="text" name="stellen" /></p>
                    <p>Beschreibung: </p>
                    <textarea id="text" name="beschreibung" cols="35" rows="4"></textarea>
                    <p><input type="submit" value="neuen Einsatzort erstellen"/></p>
                </form>
            </div>
            <footer>
                Footer
            </footer>
        </div>
    </body>
</html>
