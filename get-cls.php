<?php
require "vendor/autoload.php";
use Processor\GetRequestController;
use Processor\SystemAsset;

$systemAsset = new SystemAsset();  // creating systemasset class object
$actionType = $_GET['actionType'];
$dbConnection = $systemAsset->getDatabaseConnection();  // get the database connection
 
$getRequestController = new GetRequestController($actionType); // creating the GetRequestController class object
$check = $getRequestController->ProcessRequest($_GET['databaseId'], $_GET['largeText'], $_GET['collection'], $dbConnection); // passing argument to ProcessRequest in GetRequestController class

echo $check;