<?php

$request = $_SERVER['REQUEST_URI'];
// echo $request."<br>";

switch ($request) {
    case '':
      
    case '/':
      require "dashboard.php";
      break;

    case '/calculadora':
        require "calculadora.php";
        break;
    
    default:
        http_response_code(404);
        require "404.php";
        break;
}