<?php

namespace Processor;
use Processor\SystemAsset;

class SaveNewTodo{
    public function __construct($post) {
        
        // saveing new todo and returning the responce
        
        $sql = "insert into todo (todoText,completeStatus) values ('$post[todoText]',0)";
        $dbConnectionClass = new SystemAsset();
        $dbConnection = $dbConnectionClass->getDatabaseConnection();
        $queryResult = mysqli_query($dbConnection, $sql);
        if ($queryResult) {
            // echo "server-200";
            echo mysqli_insert_id($dbConnection);
        } else {
            echo "server-500";
        }
        
    }
}