//$(document).ready(function () {

    var base = "http://localhost:2222/api/";
    var kw = 1;
    var tabelDate = new Date();

    function getAzubiEinsaetze()
    {
        var table = document.getElementById("azubiliste");
        var uri = base + "azubi";
        var i = 1;

        $.getJSON(uri)
          .done(function (data)
          {
              // On success, 'data' contains a list of the results.
              $.each(data, function (key, item)
              {
                  // Adds results in the table.
                  var row = table.insertRow(i);
                  formatItem(item, row);
                  i++;
              });
          });
    }

    function formatItem(item, row)
    {
        var cell1 = row.insertCell(0);
        cell1.innerHTML = item.Nachname + ", " + item.Vorname;
    }

//Berechnung der Kallenderwochen die im Tabellen Header angegeben werden
    function getWeek(date)
    {
        var date = new Date();
        tableDate = date;
        var doDat = donnerstag(date);

        var kwJahr = doDat.getFullYear();
        var doKW1 = donnerstag(new Date(kwJahr, 0, 4));
        kw = Math.floor(1.5 + (doDat.getTime() - doKW1.getTime()) / 86400000 / 7);

        writeweeks(kw);
    }

    function donnerstag(date)
    {
        var date = new Date(date);
        var Do = new Date();
        Do.setTime(date.getTime() + (3 - ((date.getDay() + 6) % 7)) * 86400000);
        return Do;
    }

    function writeweeks(kw)
    {
        var table = document.getElementById("azubiliste");
        var row = table.insertRow(0);

        var highestweek = 53;

        var column = 1;
        var cell = row.insertCell(0);
        cell.innerHTML = "<b>KW</b>";
        while (column <= 12)
        {
            if (kw > highestweek)
            {
                kw = 1;
            }
            cell = row.insertCell(column);
            cell.innerHTML = "<b>" + kw + "</b>";
            kw++;
            column++;
        }
    }

    function minus4weeks()
    {
        var table = document.getElementById("azubiliste");
        table.deleteRow(0);
        kw = mod((kw - 4), 52);
        writeweeks(kw);
    }

    function plus4weeks()
    {
        var table = document.getElementById("azubiliste");
        table.deleteRow(0);
        kw = mod((kw + 4), 52);
        writeweeks(kw);
    }

    function mod(n, m)
    {
        return ((n % m) + m) % m;
    }

//})
