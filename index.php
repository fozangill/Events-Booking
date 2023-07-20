<?php 

require_once 'dbConnection.php';
require_once 'dataInsertion.php';


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

// Closing the connection
$dbConnection->getConnection()->close();

?>

