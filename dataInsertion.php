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

    private function insertEvents($dataArray) {
        $events = [];
        $existingIDs = array();
        foreach ($dataArray as $data) {

        	$eventId = $this->connection->real_escape_string($data['event_id']);

        	if(!in_array($eventId, $existingIDs)) {
        		$existingIDs[] = $eventId;

            $eventName = $this->connection->real_escape_string($data['event_name']);
            $eventDate = $this->connection->real_escape_string($data['event_date']);

            $events[$eventId] = [
            	'event_id' => $eventId,
                'event_name' => $eventName,
                'event_date' => $eventDate,

            ];


        }
    }

        $values = [];

        foreach ($events as $event) {

            $values[] = "('{$event['event_id']}', '{$event['event_name']}', '{$event['event_date']}')";
        }

        $sql = "INSERT IGNORE INTO $this->eventsTable (event_id, event_name, event_date) VALUES " . implode(', ', $values);

        if (!$this->connection->query($sql)) {
            echo "Error: " . $sql . "<br>" . $this->connection->error;
        }
    }

    private function insertParticipations($dataArray) {
        $participations = [];

        foreach ($dataArray as $data) {
            $participationId = $this->connection->real_escape_string($data['participation_id']);
            $employeeMail = $this->connection->real_escape_string($data['employee_mail']);
            $eventId = $this->connection->real_escape_string($data['event_id']);
            $participationFee = $this->connection->real_escape_string($data['participation_fee']);

            if(!empty($data['version']))
            {
            	$version = $this->connection->real_escape_string($data['version']);
            }

            else {
            	$version = 'NULL';

            }

            $participations[] = "('$participationId', '$employeeMail', '$eventId', '$participationFee', '$version')";
        }

        $sql = "INSERT IGNORE INTO $this->participationsTable (participation_id, employee_mail, event_id, participation_fee, version) VALUES " . implode(', ', $participations);

        if (!$this->connection->query($sql)) {
            echo "Error: " . $sql . "<br>" . $this->connection->error;
        }
    }
}
