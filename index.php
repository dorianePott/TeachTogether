<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020-05-25)
 * index page
 */
require_once 'model/crud_user.php';

session_start();

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

$role = ( (isset($_SESSION) || $_SESSION != array()) ? ( ($_SESSION['role'] != NULL) ? $_SESSION['role'] : 'anonyme') : 'anonyme');

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

if (!in_array($action . '-view', $permissions[$role])) {
    $action = 'default';
}

try {
    require './controller/' . str_replace('-view', '', $permissions[$role][get_key($action .'-view', $permissions[$role])] ) . '.php';

} catch (Exception $e) {
    throw $e;
}