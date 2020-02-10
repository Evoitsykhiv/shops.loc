<?php

ini_set('display_errors',1);
error_log(E_ALL);

/**
 *
 */
function debug($str){
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
    exit;
}