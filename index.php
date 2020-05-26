<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020-05-25)
 * index page
 */
require_once 'model/crud_user.php';

session_start();

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

$role = (isset($_SESSION['role']) ? $_SESSION['role'][0] : array('Cd_Role' => 'anonyme'));

/**
 * Returns the data' key
 * @param string value to search
 * @param array searching place
 * @return string key from specified element
 */
function get_key($v, $array){
    foreach ($array as $key => $value) {
        if ($value == $v) {
            return $key;
        }
    }
}

$permissions = permissions_by_role();

if (!in_array($action.'-view', $permissions[$role['Cd_Role']])) {
    $action = 'home';
}

try {
    require './controller/' . str_replace('-view', '', $permissions[$role['Cd_Role']][get_key($action .'-view', $permissions[$role['Cd_Role']])] ) . '.php';
} catch (Exception $e) {
    throw $e;
}
