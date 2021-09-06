<?php
    require('db.php'); 
    
    if(!isset($_GET['id'])) { 
        http_response_code(404);
        return;
    }
    $per_ID = $_GET["id"];
    
    
    $event_type = 1;
    $event_title = date('l')." Service"; 
    $event_id = 0;
    
    $query =  "SELECT event_id FROM events_event where DATE(event_start)=DATE(NOW())";
    if ($result = $mysqli -> query($query)) {
        if($result){
            if ($row = $result->fetch_object()){  
                $event_id = $row->event_id; 
            }else{
                
                $query = "INSERT INTO events_event (event_type, event_title, event_start, event_end)
                            VALUES ($event_type, '$event_title', NOW(), DATE_ADD(NOW(), INTERVAL 4 HOUR) );";
                
                if ($mysqli->query($query) === TRUE) {
                    $event_id = $last_id = $mysqli->insert_id;
                } else { 
                    http_response_code(404);
                    return;
                }
            }
        }
        $result -> free_result();
    }
    
    
    $query = "INSERT INTO event_attend (event_id, person_id, checkin_date)
                VALUES ($event_id, '$per_ID', NOW());";
    
    if ($mysqli->query($query) === TRUE) { 
        $event_id = $last_id = $mysqli->insert_id;
        print("true");
        http_response_code(200);
    } else {
        print("false");
        http_response_code(201);
        return;
    }
    
?>