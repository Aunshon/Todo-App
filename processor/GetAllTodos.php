<?php
namespace Processor;
class GetAllTodos{

    //  This class returns all pending and completed Todos

    public function getAllIncompleteTodos($dbConnectionClass) {
        $incompleteDatasql = "select * from todo where completeStatus=0";

        $incompleteDatasqlResult = mysqli_query($dbConnectionClass->getDatabaseConnection(), $incompleteDatasql);

        if ($incompleteDatasqlResult) {
            return $incompleteDatasqlResult;
        }
        else{
            return false;
        }
    }
    public function getAllCompleteTodos($dbConnectionClass) {
        $completeDatasql = "select * from todo where completeStatus=1";

        $completeDatasqlResult = mysqli_query($dbConnectionClass->getDatabaseConnection(), $completeDatasql);

        if ($completeDatasqlResult) {
            return $completeDatasqlResult;
        }
        else{
            return false;
        }
    }


}