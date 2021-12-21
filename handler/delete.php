<?php

require "../dbBroker.php";
require "../models/evaluation.php";

if(isset($_POST['id'])){
    $obj = new Evaluation($_POST['id']);
    $status = $obj->deleteById($conn);
    if ($status){
        echo "Success";
    }else{
        echo "Failed";
    }
}

?>