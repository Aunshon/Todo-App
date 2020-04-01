<?php
namespace Processor;
class GetRequestController extends GetRequestExecuter{

    // This class process the get request information and passes the task and information to the exucuter class

    public $actionType;
    public function __construct($actionType) {
        $this->actionType = $actionType;
    }
    
    public function ProcessRequest($databaseId, $largeText, $collection, $dbConnection)
    {
        if ($this->actionType === "todoEdit") {
            return $this->EditTodo($databaseId, $largeText, $dbConnection);
        }
        elseif ($this->actionType === "singleTodoDelete") {
            return $this->SingleTodoDelete($databaseId, $dbConnection);
        }
        elseif ($this->actionType === "todoComplete") {
            return $this->TodoComplete($databaseId, $largeText, $dbConnection);
        }
        elseif ($this->actionType === "clearAllCompleted") {
            return $this->ClearAllCompleted($dbConnection);
        }
    }
}