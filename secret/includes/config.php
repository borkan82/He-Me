<?php

define('URL', "https://secret.he-me.com/");
define('ROOT', dirname(__FILE__)."/../");
define('INC', dirname(__FILE__)."/../includes/");
define('CLASS_PATH', dirname(__FILE__)."/../class/");
define('RATE_LOG', dirname(__FILE__)."/../rate_log/");

$_CONFIG_DATABASE = array
(
    'type'		=>	'mysql5',
    'address'	=>	'localhost',
    'port'		=>	3307,
    'username'	=>	'',
    'password'	=>	'',
    'database'	=>	'heme357_db'
);
//$db = new Database($_CONFIG_DATABASE, true);
//$sql="SET NAMES utf8";
//$db->query($sql, 1);

$jsonPath = __DIR__.'/translations.json';
$jsonFile = file_get_contents( $jsonPath );
$json     = json_decode( $jsonFile, true );

$enabledLanguages = array("EN","DE","IT","ES","FR");
$la  = isset($_GET['lang']) ? addslashes($_GET['lang']) : 'EN';

session_start();
$lang = "EN";

if(isset($_GET['lang']) && in_array($_GET['lang'], $enabledLanguages)){
    $lang = $_GET['lang'];
    $_SESSION['country_origin'] = $_GET['lang'];
} else if(!empty($_SESSION['country_origin'])){
    $lang = $_SESSION['country_origin'];
}
$vbl = $json[$lang];
?>