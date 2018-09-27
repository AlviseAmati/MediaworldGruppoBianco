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

function Filter(){
var input, filter, table, tr, td, i;
input = document.getElementById("research");
filter = input.value.toUpperCase();
table = document.getElementById("tabella");
tr = table.getElementsByTagName("tr");
//col = table.getElementsByTagName("td");


for (i = 0; i < tr.length; i++) {
    //for (j = 0; j < col.length; j++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }
    }
    //} 
}

