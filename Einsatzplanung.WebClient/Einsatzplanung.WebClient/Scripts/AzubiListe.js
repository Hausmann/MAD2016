rhost = "http://localhost:2222/api/";

function getAzubi()
{
	$.getjson(rhost + "azubi/1", function (data) {
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

function azubiAlsHTMLaufbereiten(data)
{
	result = "<tr>";
	result += "<td>" + data.Vorname + "</td>";
	result += "<td>" + data.Nachname + "</td>";
	result += "<td>" + data.AzubiID + "</td></tr>";
	
	return result;
}