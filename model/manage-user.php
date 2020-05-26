<?php
/**
 * 
 */
$do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
// stripos is case-insensitive
var_dump(($do));
if (stripos($do, 'activate') !== false) {
    echo '.AAAAA.';
    $id = explode("-", $do)[1];
    //verify if user exists
    //then update it
    active_user($id);
}
