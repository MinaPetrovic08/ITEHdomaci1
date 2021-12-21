<?php

require "../dbBroker.php";
require "../models/evaluation.php";

if(isset($_POST['id'])){
    $myArray = Evaluation::getById($_POST['id'], $conn);
    echo json_encode($myArray);
}

?>