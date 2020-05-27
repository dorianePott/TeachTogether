<?php
/**
 * @author : Doriane Pott
 * @version 1.1 (2020/05/27) -> correcting bug
 */
$do = filter_input(INPUT_POST, "do", FILTER_SANITIZE_STRING);

// stripos is case-insensitive
if (stripos($do, 'activate') !== false) {
    $id = explode("-", $do)[1];
    //verify if user exists
    //then update it
    active_user($id);
}
