<?php
    require('db.php');

    class Person
    {
        public $name = '';
        public $id = '';

        function __construct(string $pid, string $pname) {
            $this->id = $pid;
            $this->name = $pname;
        }
    };
    

    $persons = array();
    if ($result = $mysqli -> query("SELECT * FROM person_per")) {
        if($result){
            while ($row = $result->fetch_object()){ 
                $person = new Person($row->per_ID, $row->per_FirstName.' '.$row->per_LastName);
                array_push( $persons , $person );
            }
        }
        $result -> free_result();
    }
    print( json_encode($persons));
?>