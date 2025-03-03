<?php
/**
 * HELP ME ajax module
 * Used for getting Gender based on name
 */
include __DIR__."/../includes/config.php";
include __DIR__."/../includes/rateLimiter.php";

include "../includes/DbPDO.php";
include "../class/functions.php";
include "../class/GenderRequests.php";

if(isset($_POST) && !empty($_POST['nameToCheck'])){ 
    $nameToCheck    = escape($_POST['nameToCheck']);
    $dbpdo          = new DbPDO();
    $GenderRequest  = new GenderRequests($dbpdo);

    $checkName          = $GenderRequest->checkName($nameToCheck);

    echo json_encode(["success"=>"1", "nameData" => $checkName]);
} else {
    echo json_encode(["error"=>"No data is sent"]);
}