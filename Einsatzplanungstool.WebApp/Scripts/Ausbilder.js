//$(document).ready(function () {

    var base = "http://localhost:2222/api/";

    function getAzubiEinsaetze() {
        var uri = base + "azubi";
        var i = 1;
        var table = document.getElementById("azubiliste");

        $.getJSON(uri)
          .done(function (data) {
              // On success, 'data' contains a list of the results.
              $.each(data, function (key, item) {
                  // Adds results in the table.
                  var row = table.insertRow(i);
                  formatItem(item, row);
                  i++;
              });
          });
    }

    function formatItem(item, row) {
        var cell1 = row.insertCell(0);
        cell1.innerHTML = item.Nachname + ", " + item.Vorname;
    }
//})