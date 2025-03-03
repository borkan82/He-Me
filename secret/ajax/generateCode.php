<?php
/**
 * HELP ME ajax module
 * Used for generating access codes
 */
include __DIR__."/../includes/config.php";
include __DIR__."/../includes/rateLimiter.php";

include "../includes/DbPDO.php";
include "../class/functions.php";
include "../class/SecretRequests.php";

if(isset($_POST) && !empty($_POST['secretText'])){
    $secretText         = escape($_POST['secretText']);
    $expirationPeriod   = escape($_POST['expirationPeriod']);

    $randomCode         = generateRandomCode();
    $dbpdo          = new DbPDO();
    $SecretRequest  = new SecretRequests($dbpdo);

    $checkCode          = $dbpdo->fetchOne("SELECT * FROM secret_requests WHERE `code` LIKE '".$randomCode."'");
    if(!empty($checkCode)) {
        $randomCode         = generateRandomCode();
    }

    $insertData = [
        "secret_text" =>    $secretText,
        "hash" =>           "",
        "code" =>           $randomCode,
        "expiration_days" => $expirationPeriod,
        "ip"              => $SecretRequest->getIpAddress()
    ];
    $SecretRequest->insertData($insertData);

    $linkGenerated = "https://secret.he-me.com/secure/".$randomCode;

    echo json_encode(["success"=>"1", "secretLink" => $linkGenerated]);
} else {
    echo json_encode(["error"=>"No data is sent"]);
}