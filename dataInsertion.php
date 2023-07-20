<?php

// dataInsertion.php
class DataInsertion {
    private $connection;
    private $employeesTable;
    private $eventsTable;
    private $participationsTable;

    public function __construct($connection, $employeesTable, $eventsTable, $participationsTable) {
        $this->connection = $connection;
        $this->employeesTable = $employeesTable;
        $this->eventsTable = $eventsTable;
        $this->participationsTable = $participationsTable;
    }

    public function insertData($dataArray) {
    	$this->insertEmployees($dataArray);
        $this->insertEvents($dataArray);
        $this->insertParticipations($dataArray);
    }

    private function insertEmployees($dataArray) {
        $employees = [];
        $existingMails = array();
        foreach ($dataArray as $data) {
            
            $employeeMail = $this->connection->real_escape_string($data['employee_mail']);

            if(!in_array($employeeMail, $existingMails)) {
        		$existingMails[] = $employeeMail;

            	$employeeName = $this->connection->real_escape_string($data['employee_name']);

	            $employees[$employeeMail] = [
	            	
	                'employee_name' => $employeeName,
	                'employee_mail' => $employeeMail,
	                
	            ];
	        }
	    }

        $values = [];

        foreach ($employees as $employee) {
            $values[] = "('{$employee['employee_name']}', '{$employee['employee_mail']}')";
        }

        $sql = "INSERT IGNORE INTO $this->employeesTable (employee_name, employee_mail) VALUES " . implode(', ', $values);

        if (!$this->connection->query($sql)) {
            echo "Error: " . $sql . "<br>" . $this->connection->error;
        }
    }


}
