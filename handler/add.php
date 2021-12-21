<?php

require "../dbBroker.php";
require "../models/evaluation.php";

if(isset($_POST['student']) && isset($_POST['subject']) 
&& isset($_POST['points']) && isset($_POST['note'])){
    $grade = new Evaluation(null,$_POST['student'],$_POST['subject'],$_POST['points'],$_POST['note'] );
    $status = Evaluation::add($grade, $conn);

    if($status){
        echo 'Success';
    }else{
        echo $status;
        echo "Failed";
    }
}


?>