<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * 
 * ===================================================
 *   Place all functions to be evaluated in code.php
 * ===================================================
 * 
 */

include_once 'models/analysis.class.php';

$files = new FilesystemIterator('code', FilesystemIterator::SKIP_DOTS);
foreach($files as $file) include_once $file;

$num = 1;
$user_results = [];

$functions = get_defined_functions();
$user_functions = $functions['user'];

foreach($user_functions as $user_function)
{
    $params = [];
    $reflection = new ReflectionFunction($user_function);
    $function_parameters = $reflection->getParameters();
    foreach($function_parameters as $function_parameter)
    {
        switch($function_parameter->getType())
        {
            case "string": 
                $params[] = substr(md5(mt_rand()), 0, 10); 
            break;

            case "bool":
                $params[] = (bool) random_int(0, 1);
            break;

            case "int": 
            default:
                $params[] = 100; 
            break;
        }
    }

    ${'test'.$num} = new Analysis($user_function, $params);
    ${'test'.$num}->analyse();

    $user_results[] = ${'test'.$num};

    $num++;
}

include 'layout/display.php';