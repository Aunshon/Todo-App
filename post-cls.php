<?php

require "vendor/autoload.php";
use Processor\SaveNewTodo;


$responce = new SaveNewTodo($_POST);  // passing the new argument to SaveNewTodo class to save new todo
if ($responce) {
    return true;
}