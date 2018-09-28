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
    $sql1 = "SELECT * FROM " .$_GET['tabella']. " WHERE ";
    while($field = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<th onclick='sorting($i);'>".$field['Field']."</th>";
        $sql1.=$field['Field']." like '%".$_GET['filter']."%' OR ";
        $i++;
    }    
    $sql1=substr($sql1, 0, -3);
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

    
    $sql1.="LIMIT ".$primo.",".$perpage;
    $stmt1 = $db->prepare($sql1);        
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

    echo'<nav align="right"><ul class="pagination">';

    if($page-$pagination>0)    {
        echo'<li class="page-item">
        <a class="page-link" href="View.php?tabella='.$_GET['tabella'].'&page='.($page-$pagination).'">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
        </a>
        </li>';
    }
    else{
        echo'<li class="page-item">
        <a class="page-link" href="View.php?tabella='.$_GET['tabella'].'&page=1">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
        </a>
        </li>';
    }
    echo '<li class="page-item"><a class="page-link" href="View.php?tabella='.$_GET['tabella'].'&page=1">1</a></li>';
    
    if($tot_pagine>1)
    {
        if($page>$tot_pagine-floor($pagination/2))
        {
            if($page-$pagination>0)
            {
                for($i=$page-$pagination; $i<=$tot_pagine; $i++)    {
                    echo'<li class="page-item"><a href="View.php?tabella='.$_GET['tabella'].'&page='.$i.'">'.$i.'</a></li>';
                }
            }
            else
            {
                for($i=2; $i<=$pagination; $i++)    {
                    echo'<li class="page-item"><a href="View.php?tabella='.$_GET['tabella'].'&page='.$i.'">'.$i.'</a></li>';
                }
            }
        }
        else
        {
            if($page>floor($pagination/2)&&$page<$tot_pagine-floor($pagination/2))    {
                for($i=$page-floor($pagination/2); $i<=$page+floor($pagination/2); $i++)    {
                    echo'<li class="page-item"><a href="View.php?tabella='.$_GET['tabella'].'&page='.$i.'">'.$i.'</a></li>';
                }
            }
            else
            {
                for($i=2; $i<=$pagination; $i++)    {
                    echo'<li class="page-item"><a href="View.php?tabella='.$_GET['tabella'].'&page='.$i.'">'.$i.'</a></li>';
                }
            }

            echo '<li class="page-item"><a class="page-link" href="View.php?tabella='.$_GET['tabella'].'&page='.$tot_pagine.'">'.$tot_pagine.'</a></li>';
        }
    }
    if($page+$pagination<=$tot_pagine)    {
        echo'<li class="page-item">
        <a class="page-link" href="View.php?tabella='.$_GET['tabella'].'&page='.($page+$pagination).'">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
        </a>
        </li>';
    }
    else
    {
        echo'<li class="page-item">
        <a class="page-link" href="View.php?tabella='.$_GET['tabella'].'&page='.$tot_pagine.'">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
        </a>
        </li>';
    }
    echo '</ul></nav>';
    
}
catch (PDOException $e) {
    echo $e->getMessage();  
}