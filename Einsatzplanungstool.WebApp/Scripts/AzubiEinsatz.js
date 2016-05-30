rhost = "http://localhost:2222/api/";

function getEinsaetze(id) {
    $(document).ready(function () {
        $.get(rhost + "azubiii/" + id + "/einsaetze", function (data) {
            alert("success");
            $("#einsatztabelle").append(einsatzAufbereiten(data));

        }).fail(function () {
            alert("error");
            var testEinsatz = new Object();
            testEinsatz.einsatzID = "2";
            testEinsatz.AbteilungID = "7";
            testEinsatz.VonDatum = "2016-07-18";
            testEinsatz.BisDatum = "2016-09-09";
            testEinsatz.Status = "genehmigt";
            $("#einsatztabelle").append(einsatzAufbereiten(testEinsatz));
        });
    });
}

function einsatzAufbereiten(data) {
    result = "<tr>";
    result += "<td>" + data.einsatzID + "</td>";
    result += "<td>" + data.AbteilungID + "</td>";
    result += "<td>" + data.VonDatum + "</td>";
    result += "<td>" + data.BisDatum + "</td>";
    result += "<td>" + data.Status + "</td>";
    result += "</tr>";

    return result;
}