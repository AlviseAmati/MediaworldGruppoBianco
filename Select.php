<?php
include("Config.php");
try {
    $db = new PDO ("mysql:host=$hostname;dbname=$dbname", $username, $password, array(PDO::ATTR_PERSISTENT => true));
    $sql = "SHOW COLUMNS From ".$_GET['tabella'];    
    $stmt = $db->prepare($sql);        
    $stmt->execute();
    echo"<table class='table table-hoover' id='tabella'>";
    echo "<thead><tr>";
    $i=0;
    while($field = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<th onclick='sorting($i);'>".$field['Field']."</th>";
        $i++;
    }    
    echo "</tr></thead>";
    

    $sql = "SELECT COUNT(*) FROM ".$_GET['tabella'];
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchColumn(); 
    $tot_records = $rows;
    $page = 1;
    if(isSet($_GET['page']))
    {$page = filter_var($_GET['page'],FILTER_SANITIZE_NUMBER_INT);}
    $tot_pagine = ceil($tot_records/$perpage);
    $pagina_corrente = $page;
    $primo = ($pagina_corrente-1)*$perpage;

    
    $sql = "SELECT * FROM " .$_GET['tabella']. " LIMIT ".$primo.",".$perpage;
    $stmt1 = $db->prepare($sql);        
    $stmt1->execute(); 
    
    while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        $sql = "SHOW COLUMNS From ".$_GET['tabella'];    
        $stmt = $db->prepare($sql);        
        $stmt->execute();
        $i=0;
        while($field = $stmt->fetch(PDO::FETCH_ASSOC)){
            $campo=$row[$field['Field']];
            echo "<td onclick='sorting($i);'>" .$campo. "</td>";
        }
        echo "</tr>";
    }
    echo"</table>";

    echo'<nav><ul class="pagination">';

    if($i-5>0)    {
        echo'<li class="page-item">
        <a class="page-link" href="View.php?tabella='.$_GET['tabella'].'&page='.($i-5).'">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
        </a>
        </li>';
    }

    if($page>1)
    {
        echo '<li class="page-item"><a class="page-link" href="View.php?tabella='.$_GET['tabella'].'&page=1">1</a></li>';
        for($i=1; $i<=$tot_pagine; $i++)    {
            echo'<li class="page-item"><a href="View.php?tabella='.$_GET['tabella'].'&page='.$i.'">'.$i.'</a></li>';
        }
        if($page<$tot_pagine)
        echo '<li class="page-item"><a class="page-link" href="View.php?tabella='.$_GET['tabella'].'&page='.$tot_pagine.'">'.$tot_pagine.'</a></li>';
        if($i+5<=$tot_pagine)    {
            echo'<li class="page-item">
            <a class="page-link" href="View.php?tabella='.$_GET['tabella'].'&page='.($i+5).'">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
            </a>
            </li>';
        }

        echo '</ul></nav>';
    }
} 
catch (PDOException $e) {
    echo $e->getMessage();  
}