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
        $("#ausbildertabelle").append(AddOptionToCombobox(data));

    }).fail(function ()
    {
        alert("error");
    });

}


function AddOptionToCombobox(data)
{
    var cbausbilder = document.getElementById("ausbildercombobox");
    for (var i = 0; i < data.length; i++)
    {
       var option = document.createElement("option");    
       option.text = data.Vorname + data.Nachname;
       option.value = i;
       cbausbilder.option.AddOptionToCombobox(option);
    }
    
    


    
}

function azubiAlsHTMLaufbereiten(data)
{

    result = "<tr>";
    result += "<td><a href='AzubiEinzelAnsicht' class='notunderline' onclick='azubiClicked()'>" + data.Vorname + "</a></td>";
    result += "<td><a href='AzubiEinzelAnsicht'class='notunderline' onclick='azubiClicked()'>" + data.Nachname + "</a></td>";
    result += "<td><a href='AzubiEinzelAnsicht'class='notunderline' onclick='azubiClicked()'>" + data.PersNr + "</a></td>";
    result += "<td><a href='AzubiEinzelAnsicht'class='notunderline' onclick='azubiClicked()'>" + data.HeimatKOE + "</a></td>";
    result += "<td><a href='AzubiEinzelAnsicht'class='notunderline' onclick='azubiClicked()'>" + data.Fachausbilder + "</a></td>";
    result += "<td><a href='AzubiEinzelAnsicht'class='notunderline' onclick='azubiClicked()'>" + data.Beruf + "</a></td></tr>";
	return result;
}

function azubiClicked(dataObject){
    sessionStorage.setItem("personalNr", "hier übergabeparameter");
}