<?php
namespace Processor;
use mysqli;
class SystemAsset{

    // In this class we have some inportant functionalities to run the application
    // like database connection

    public function getDatabaseConnection(){
        $hostName = 'localhost';
        $userName = 'root';
        $password = '';
        $db = "db_todoapp";

        $dbConnection = new mysqli($hostName, $userName, $password, $db);
        if ($dbConnection) {
            return $dbConnection;
        } else {
            return "connection failed";
        }
    }
}