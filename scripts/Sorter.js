function sorting(value){         
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("tabella");
    switching = true;
    if(!isNumeric(table.rows[1].cells[value].innerHTML)){
        while (switching) {
            //ordinamento alfabetico

            switching = false;
            rows = table.getElementsByTagName("TR");
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[value];
                y = rows[i + 1].getElementsByTagName("TD")[value];
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch= true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
   else
    {
        while(switching){
            switching=false;
            for (var i = 1; i < table.rows.length-1; i++) {
                if(parseFloat(table.rows[i].cells[value].innerHTML)>parseFloat(table.rows[i+1].cells[value].innerHTML)){
                    table.rows[i].parentNode.insertBefore(table.rows[i+1], table.rows[i]);
                    switching=true;
                }
            }
        }
    }
    
}

function isNumeric(n) {
    return !isNaN(parseInt(n));
}