<?php

require_once 'Api.php';
require_once '../model/Random.php';



//echo $_SERVER['REQUEST_URI'] . '' .  $_SERVER["REQUEST_METHOD"] ;

$method = $_POST['method'] ?? false;
$seed = $_POST['seed'] ?? false;

$api = new Api($method, $seed);
$api->processRequest();

