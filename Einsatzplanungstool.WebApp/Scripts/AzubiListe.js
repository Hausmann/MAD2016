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

function GetAusbilderId()
{
    $.get(rhost + "")
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
	result += "<td>" + data.Vorname + "</td>";
	result += "<td>" + data.Nachname + "</td>";
	result += "<td>" + data.AzubiID + "</td></tr>";
	
	return result;
}