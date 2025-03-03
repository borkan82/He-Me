<?php
/**
 * HELP ME ajax module
 * Used for generating access codes
 */
//include __DIR__."../includes/config.php";
include "../includes/DbPDO.php";
include "../class/functions.php";
include "../class/SecretRequests.php";

if(isset($_POST) && !empty($_POST['secretCode'])){
    $secretCode         = escape($_POST['secretCode']);

    $dbpdo          = new DbPDO();
    $SecretRequest  = new SecretRequests($dbpdo);

    $deactivateCode          = $dbpdo->update("UPDATE secret_requests SET active=0 WHERE `code` LIKE '".$secretCode."'");

    echo json_encode(["success"=>"1"]);
} else {
    echo json_encode(["error"=>"No data is sent"]);
}