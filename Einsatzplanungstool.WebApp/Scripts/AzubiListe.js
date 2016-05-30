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
    $.get(rhost + "ausbilder/" + ausbilderId + "/azubiAnsicht", function (data)
    {
        for (var i = 0; i < data.length; i++)
        {
            $("#azubitabelle").append(azubiAlsHTMLaufbereiten(data[i]));
function GetAusbilderId()
{
    $.get(rhost + "")
}

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


function PostAzubi(info)
{
    $.ajax({
        type: "POST",
        url: rhost + "azubi",
        contentType: "application/json",
        data: info,
        success: alert("Succes")
    });
}

function getAusbilderNames()
{
    $.get(rhost + "ausbilder", function (data)
    {
        alert("success");
        $("#ausbildertabelle").append(AddOptionToComboboxAusbilder(data));
        $("#ausbildertabelle").append(AddOptionToCombobox(data));

    }).fail(function ()
    {
        alert("error");
    });

}

function getBerufe() {
    $.get(rhost + "berufe", function (data)
    {   
        $("#berufetabelle").append(AddOptionToComboboxBerufe(data));
    }).fail(function () {
        alert("error");
    });
}



function getAbteilungen()
{
    $.get(rhost + "abteilungen", function (data)
    {
        $("#abteilungentabelle").append(AddOptionToComboboxAbteilungen(data));
    }).fail(function () {
        alert("error");
    });
}


function AddOptionToComboboxAusbilder(data)
{
    var cbausbilder = document.getElementById("Ausbilder");
    for (var i = 0; i < data.length; i++)
    {
       var option = document.createElement("option");    
        option.text = data[i].Vorname + " " + data[i].Nachname;
        option.value = data[i].AusbilderId;
        cbausbilder.add(option);
    }
    }
    
function AddOptionToComboboxBerufe(data) {
    var cbausbilder = document.getElementById("Beruf");
    for (var i = 0; i < data.length; i++)
    {
        var option = document.createElement("option");
        option.text = data[i].Beschreibung;
        option.value = data[i].BerufID;
        cbausbilder.add(option);
    }
}

function AddOptionToComboboxAbteilungen(data)
{
    var cbabteilung = document.getElementById("Heimatabteilung");
    for (var i = 0; i < data.length; i++)
    {
        var option = document.createElement("option");
        option.text = data[i].KOE + ", " + data[i].Beschreibung;
        option.value = data[i].AbteilungID;
        cbabteilung.add(option);
    }
}

    

function azubiAlsHTMLaufbereiten(data)
{

	result = "<tr>";
    result += "<td><a href='AzubiEinzelAnsicht' class='notunderline'>" + data.Vorname + "</a></td>";
    result += "<td><a href='AzubiEinzelAnsicht'class='notunderline'>" + data.Nachname + "</a></td>";
    result += "<td><a href='AzubiEinzelAnsicht'class='notunderline'>" + data.PersNr + "</a></td>";
    result += "<td><a href='AzubiEinzelAnsicht'class='notunderline'>" + data.HeimatKOE + "</a></td>";
    result += "<td><a href='AzubiEinzelAnsicht'class='notunderline'>" + data.Fachausbilder + "</a></td>";
    result += "<td><a href='AzubiEinzelAnsicht'class='notunderline'>" + data.Beruf + "</a></td></tr>";
	return result;
}