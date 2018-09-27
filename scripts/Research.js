function Ricerca()
{
    //colora le celle dove trova la stringa passata
    Reset();
    var stringa = document.getElementById("research").value.toUpperCase();
    if(stringa!=""&&stringa!=".") {
        var table = document.getElementById("tabella");
        var celle = table.getElementsByTagName("td");
        for (var j = 0; j < celle.length; j++) {
            if (celle[j].innerHTML.toUpperCase().search(stringa) !== -1 && celle[j].innerHTML.toUpperCase().search("<") === -1) {
                celle[j].style.backgroundColor = "#99ddff";
            }
        }
    }
}

function Reset() {
    //imposta tutte le celle al colore bianco
    var table = document.getElementById("tabella");
    var celle = table.getElementsByTagName("td");
    for(var j=0; j<celle.length; j++){
            celle[j].style.backgroundColor="white";
    }
}

function Filter(tabella){
    filter = document.getElementById("research").value.toUpperCase();
    $("#tabella").load("Filter.php?tabella=" +tabella+ "&filter="+filter);
}


