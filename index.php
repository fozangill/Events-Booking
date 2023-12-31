<?php 

require_once 'dbConnection.php';
require_once 'dataInsertion.php';
require_once 'FilteringData.php';

// DB configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "all_events";
$employeesTable = "employees";
$eventsTable = "events";
$participationsTable = "participations";

// DB object creation
$dbConnection = new DBConnection($servername, $username, $password, $dbname);
$dbConnection->connect();

//Reading JSON data
$jsonFile = 'events.json';
$jsonData = file_get_contents($jsonFile);
$dataArray = json_decode($jsonData, true);

//Object creation of DataInsertion class
// Data insertion
$dataInsertion = new DataInsertion($dbConnection->getConnection(), $employeesTable, $eventsTable, $participationsTable);

$dataInsertion->insertData($dataArray);

$dataFilter = new FilteringData($dbConnection->getConnection());

// Getting the input filter values
$employeeNameFilter = isset($_GET['employee_name']) ? $_GET['employee_name'] : '';
$eventIDFilter = isset($_GET['event_name']) ? $_GET['event_name'] : '';
$eventDateFilter = isset($_GET['event_date']) ? $_GET['event_date'] : '';

// Getting filtered results
$filteredData = $dataFilter->getFilteredResults($employeeNameFilter, $eventIDFilter, $eventDateFilter);

// function call to calculate total price of filtered results
$totalPrice = $dataFilter->getTotalPrice($employeeNameFilter, $eventIDFilter, $eventDateFilter);

// Closing the connection
$dbConnection->getConnection()->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Filtered Results</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Filter Results</h1>

    <form method="GET" action="">
        <label for="employee">Employee Name:</label>
        <input type="text" id="employee_name" name="employee_name" value="<?= htmlspecialchars($employeeNameFilter) ?>">

        <label for="event">Event Name:</label>
        <input type="text" id="event_name" name="event_name" value="<?= htmlspecialchars($eventIDFilter) ?>">

        <label for="date">Event Date:</label>
        <input type="date" id="event_date" name="event_date" value="<?= htmlspecialchars($eventDateFilter) ?>">

        <button type="submit">Filter</button>
    </form>

    <table>
        <tr>
            <th>Participation ID</th>
            <th>Employee Name</th>
            <th>Employee Mail</th>
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Participation Fee</th>
            <th>Event Date</th>
            <th>Version</th>
        </tr>
        <?php foreach ($filteredData as $data): ?>
            <tr>
                <td><?php htmlspecialchars($data['participation_id']) ?></td>
                <td><?php htmlspecialchars($data['employee_name']) ?></td>
                <td><?php htmlspecialchars($data['employee_mail']) ?></td>
                <td><?php htmlspecialchars($data['event_id']) ?></td>
                <td><?php htmlspecialchars($data['event_name']) ?></td>
                <td><?php htmlspecialchars($data['participation_fee']) ?></td>
                <td><?php htmlspecialchars($data['event_date']) ?></td>
                <td><?php htmlspecialchars($data['version']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

<p>Total Price of Filtered Participation Fee: <?= htmlspecialchars($totalPrice) ?></p>

</body>
</html>