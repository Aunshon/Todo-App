<?php

require "vendor/autoload.php";

use Processor\GetAllTodos;
use Processor\SystemAsset;

$allTodos = new GetAllTodos();
$inConpletedTodos = $allTodos->getAllIncompleteTodos(new SystemAsset);
$conpletedTodos = $allTodos->getAllCompleteTodos(new SystemAsset);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Css links -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="asset/css/materialize.min.css">
    <link rel="stylesheet" href="asset/css/aun-my.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assignment</title>
</head>

<body>

    <!-- ====================================================
    == Container start here
    ===================================================== -->

    <div class="container">
        <!-- card title -->
        <div class="row">
            <h1 class="center pink-text text-lighten-4">Todos</h1>
        </div>
        <div class="row">
            <div class="col s10 offset-s1 offset-m1 offset-l1">

                <!-- ====================================================
    == Todo Content stat here
    ===================================================== -->

                <div class="card">
                    <div class="card-content">
                        <span class="card-title">
                            <form action="post-cls.php" method="POST" id="todoForm">
                                <input name="todoText" type="text" placeholder="What needs to be done ?" id="newTodo">
                            </form>
                        </span>
                        <!-- ====================================================
    == All incompleted todo start here
    ===================================================== -->
                        <table id="allTbl" class="responsive-table">
                            <tbody id="alltblbody">
                                <?php
                                if (mysqli_num_rows($inConpletedTodos) > 0) {
                                    while ($row = mysqli_fetch_array($inConpletedTodos)) {
                                ?>
                                        <tr>
                                            <td class="">
                                                <p>
                                                    <input type="checkbox" name="todo" id="<?php echo $row["id"] ?>" class="aun-editable" data-databaseid="<?php echo $row["id"] ?>" data-databasevalue="<?php echo $row["todoText"] ?>">
                                                    <label for="<?php echo $row["id"] ?>"><span class="black-text lighten-4 aun-editable todovalue"><?php echo $row["todoText"] ?></span></label>
                                                </p>
                                            </td>
                                            <td class="aun-hide-it hide-on-med-and-down">
                                                <input type="text" placeholder="Edit Here" value="<?php echo $row["todoText"] ?>" class="edited-input" data-databaseid="<?php echo $row["id"] ?>" data-databasevalue="<?php echo $row["todoText"] ?>">
                                            </td>
                                            <td class=""><a class="recentTodoClose" data-databaseid="<?php echo $row["id"] ?>" href="#"><i class="material-icons right red-text" data-databaseid="<?php echo $row["id"] ?>">close</i></a></td>

                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- ====================================================
    == All incompleted todo ends here
    ===================================================== -->

                        <!-- ====================================================
    == All completed todo starts here
    ===================================================== -->
                        <table id="completedTbl" class="aun-hide-it responsive-table">
                            <tbody id="completedtblbody">
                                <?php
                                if (mysqli_num_rows($conpletedTodos) > 0) {
                                    while ($row = mysqli_fetch_array($conpletedTodos)) {

                                ?>
                                        <tr>
                                            <td>
                                                <h5 class="grey-text aun-strik" data-databaseid="<?php echo $row["id"]  ?>"><?php echo $row["todoText"]  ?></h5>
                                            </td>
                                            <td class=""><a class="recentTodoClose" data-databaseid="<?php echo $row["id"] ?>" href="#"><i class="material-icons right red-text" data-databaseid="<?php echo $row["id"] ?>">close</i></a></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- ====================================================
    == All completed todo ends here
    ===================================================== -->

                    </div>
                    <!-- Todo Action Area start -->
                    <div class="card-action" id="card-action">
                        <span><span id="itemleft">3</span> item left</span>
                        <a href="#" class="right black-text" id="clearCompleteBtn">Clear Completed</a>
                        <a href="#" class="right black-text" id="completeBtn">Completed</a>
                        <a href="#" class="right black-text" id="activeBtn">Active</a>
                        <a href="#" class="right black-text" id="allBtn">All</a>
                    </div>
                    <!-- Todo Action Area end -->
                </div>
                <!-- ====================================================
    == Todo content ends here
    ===================================================== -->
            </div>
        </div>
    </div>
    <!-- ====================================================
    == Container ends here
    ===================================================== -->

    <!-- My js start -->
    <script src="asset/js/jquery-3.2.1.min.js"></script>
    <script src="asset/js/materialize.min.js"></script>
    <script src="asset/js/aun-my.js"></script>
    <!-- My js end -->
</body>

</html>