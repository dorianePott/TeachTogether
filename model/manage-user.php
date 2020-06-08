<?php
/**
 * @author : Doriane Pott
 * @version 1.1 (2020/05/27) -> correcting bug
 * management page for users
 */
$do = filter_input(INPUT_POST, "do", FILTER_SANITIZE_STRING);

// stripos is case-insensitive
if (stripos($do, 'deactivate') !== false) {
    $id = explode("-", $do)[1];
    //verify if user exists
    //then update it
    deactivate_user($id);
} else if (stripos($do, 'activate') !== false) {
    $id = explode("-", $do)[1];
    active_user($id);
}
