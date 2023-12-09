<?php

    
    include_once "../../DB_connection.php";
    
    $table = $_GET['table'] ?? 'null';
    if($table == 'null') echo "Need passing of 'table' name";
    else{
        $sql = "SELEcT id,password FROM ". $_GET['table'] ;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() >= 1){
            $items = $stmt->fetchAll();
        }
        
        
        function password_is_hash($password)
        {
            return password_get_info($password)['algoName'] !== 'unknown';
        }

        $count = 0;
        foreach ($items as $key=> $id){
            
            if(!password_is_hash($id['password'])){
                $id['password'] = password_hash($id['password'],PASSWORD_BCRYPT);
                $count++;
                
            }
            
            $pass = $id['password'];
            $id_item = $id['id'];
            $sql = "UPDATE ". $_GET['table'] ." SET password='$pass' WHERE id = $id_item";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }
        
        echo "Encrypted " . $count . " Password(s)";
        
        
        }
    

?>