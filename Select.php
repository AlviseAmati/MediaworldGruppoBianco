<?php
include("Config.php");
try {
    $db = new PDO ("mysql:host=$hostname;dbname=$dbname", $username, $password, array(PDO::ATTR_PERSISTENT => true));
    $sql = "SHOW COLUMNS From ".$_GET['tabella'];    
    $stmt = $db->prepare($sql);        
    $stmt->execute();    
    echo "<thead><tr>";
    $i=0;
    while($field = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<th onclick='sorting($i);'>".$field['Field']."</th>";
        $i++;
    }    
    echo "</tr></thead>";

    $sql = "SELECT * FROM " .$_GET['tabella'];
    $stmt1 = $db->prepare($sql);        
    $stmt1->execute(); 

    while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        $sql = "SHOW COLUMNS From ".$_GET['tabella'];    
        $stmt = $db->prepare($sql);        
        $stmt->execute();
        $i=0;
        $val=0;
        while($field = $stmt->fetch(PDO::FETCH_ASSOC)){
            if($i==0)
                $val=$row[$field['Field']];
            $campo=$row[$field['Field']];
            echo "<td onclick='sorting($i);'>" .$campo. "</td>";
            $i++;
        }
        echo "</tr>";
    }
} 
catch (PDOException $e) {
    echo $e->getMessage();  
}