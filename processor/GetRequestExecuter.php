<?php
namespace Processor;
class GetRequestExecuter{
    // Class Starts Here
    // this class executes all the query and returns the responce

    
    function EditTodo($id,$todoText, $dbConnection)
    {
        $sql = "UPDATE todo SET todoText='$todoText' WHERE id='$id'";
        if ($this->AunQueryToDatabase($dbConnection,$sql)) {
            return true;
        } else {
            return false;
        } 
    }

    function SingleTodoDelete($databaseId, $dbConnection)
    {
        $sql = "DELETE FROM todo WHERE id='$databaseId'";
        if ($this->AunQueryToDatabase($dbConnection, $sql)) {
            return true;
        } else {
            return false;
        } 
    }

    function TodoComplete($databaseId, $largeText, $dbConnection)
    {
        $sql = "UPDATE todo SET completeStatus='$largeText' WHERE id='$databaseId'";
        if ($this->AunQueryToDatabase($dbConnection, $sql)) {
            return true;
        } else {
            return false;
        } 
    }

    function ClearAllCompleted($dbConnection)
    {
        $sql = "DELETE FROM todo WHERE completeStatus=1";
        if ($this->AunQueryToDatabase($dbConnection, $sql)) {
            return true;
        } else {
            return false;
        } 
    }










    function AunQueryToDatabase($dbConnection,$sql)
    {
        return mysqli_query($dbConnection,$sql);
    }

    //Class Ends Here
}