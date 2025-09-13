<?php

header('Content-Type: application/json');
require_once "../model/machine.php";
require_once "../model/dataAccess.php";

if (isset($_GET["query"])) {
    $query = $_GET["query"];
    $machines = getMachinesByTitle($query);  


    $results = [];
    foreach ($machines as $machine) {
        $results[] = ['machineName' => $machine->machineName, 'company' => $machine->company];
    }
    
    echo json_encode($results); 
} else {
    echo json_encode([]); 
}
?>