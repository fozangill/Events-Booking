<?php 

class FilteringData {
	
	private $connection;
	private $fetchData;

    public function __construct($connection) {
        $this->connection = $connection;
       
    }

    public function getFilteredResults($employeeNameFilter, $eventIDFilter, $eventDateFilter)
    {
        $employeeNameFilter = '%' . $employeeNameFilter . '%';
        $eventIDFilter = '%' . $eventIDFilter . '%';
        $eventDateFilter = '%' . $eventDateFilter . '%';

        $query = "SELECT employees.employee_name, participations.participation_id, events.event_name, participations.participation_fee, events.event_date, participations.event_id, participations.employee_mail, participations.version
                  FROM participations
                  INNER JOIN employees ON participations.employee_mail = employees.employee_mail
                  INNER JOIN events ON participations.event_id = events.event_id
                  WHERE employees.employee_name LIKE '$employeeNameFilter'
                    AND events.event_name LIKE '$eventIDFilter'
                    AND events.event_date LIKE '$eventDateFilter'";

        $result = $this->connection->query($query);

        $filteredParticipations = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $filteredParticipations[] = $row;
            }
        }

        return $filteredParticipations;
    }


    public function getTotalPrice($employeeNameFilter, $eventIDFilter, $eventDateFilter)
    {
        $employeeNameFilter = '%' . $employeeNameFilter . '%';
        $eventIDFilter = '%' . $eventIDFilter . '%';
        $eventDateFilter = '%' . $eventDateFilter . '%';

        $query = "SELECT SUM(participation_fee) AS total_price
                  FROM participations
                  INNER JOIN employees ON participations.employee_mail = employees.employee_mail
                  INNER JOIN events ON participations.event_id = events.event_id
                  WHERE employees.employee_name LIKE '$employeeNameFilter'
                    AND events.event_name LIKE '$eventIDFilter'
                    AND events.event_date LIKE '$eventDateFilter'";

        $result = $this->connection->query($query);
        $totalPriceResult = $result->fetch_assoc();
        return $totalPriceResult['total_price'];
    }


}