var base = "http://localhost:2222/api/";

function getNameAsOption(uri, id) {
    uri = base + uri;
    var x = document.getElementById(id);

    $.getJSON(uri)
      .done(function (data) {
          // On success, 'data' contains a list of the results.
          $.each(data, function (key, item) {
              // Adds results in the table.
              var option = document.createElement("option");
              option.text = item.Nachname + ", " + item.Vorname;
              x.add(option);
          });
      });
}

function getAbteilungAsOption(uri, id) {
    uri = base + uri;
    var x = document.getElementById(id);

    $.getJSON(uri)
      .done(function (data) {
          // On success, 'data' contains a list of the results.
          $.each(data, function (key, item) {
              // Adds results in the table.
              var option = document.createElement("option");
              option.text = item.KOE;
              x.add(option);
          });
      });
}