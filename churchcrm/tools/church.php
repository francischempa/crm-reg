<?php
    require('db.php'); 

    if ($result = $mysqli -> query("SELECT cfg_value FROM config_cfg where cfg_name=\"sChurchName\"")) {
        if($result){
            $row = $result->fetch_assoc();  
            $data = $row["cfg_value"];
            echo "\"$data\"";
        }
        $result -> free_result();
    }

?>