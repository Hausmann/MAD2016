rhost = "http://localhost:2222/api/";

function getAzubi()
{
	$.get(rhost + "azubi/1", function (data) {
		alert("success");
		$("#azubitabelle").append(azubiAlsHTMLaufbereiten(data));

	}).fail(function () {
		alert("error");
		var testazubi = new Object();
		testazubi.Nachname = "Mustermann";
		testazubi.Vorname = "Max";
		testazubi.AzubiID = 11;
		$("#azubitabelle").append(azubiAlsHTMLaufbereiten(testazubi));
	});
	
}

function getAzubis(ausbilderId)
{
    $.get(rhost + "ausbilder/" + ausbilderId + "/azubiAnsicht", function (data) {
        alert("success");
        for (var i = 0; i < data.length; i++)
        {
            $("#azubitabelle").append(azubiAlsHTMLaufbereiten(data[i]));

        }

    }).fail(function () {
        alert("error");
        var testazubi = new Object();
        testazubi.Nachname = "Mustermann";
        testazubi.Vorname = "Max";
        testazubi.AzubiID = 11;
        $("#azubitabelle").append(azubiAlsHTMLaufbereiten(testazubi));
    });
}

function azubiAlsHTMLaufbereiten(data)
{

	result = "<tr>";
	result += "<td>" + data.Vorname + "</td>";
	result += "<td>" + data.Nachname + "</td>";
	result += "<td>" + data.PersNr + "</td>";
	result += "<td>" + data.HeimatKOE + "</td>";
	result += "<td>" + data.Fachausbilder + "</td>";
	result += "<td>" + data.Beruf + "</td></tr>";
	return result;
}