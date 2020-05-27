<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020-05-25)
 * index page
 */
require_once 'model/crud_user.php';

session_start();
#region Init
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$permissions = array();
if (isset($_SESSION['permissions'])) {
    $perm = $_SESSION['permissions'];
} else {
    $perm = get_anonyme_perm();
}
foreach ($perm as $p) {
    foreach ($p as $key => $value) {
        $permissions[] = $value;
    }
}
#endregion
/**
 * check if value in multi-dimensional array 2 : [][]
 * @param string element
 * @param array array
 */
function in_multi_array($element, $array){
    foreach ($array as $key => $value) {
        if ($value == $element) {
            return true;
        }
    }
    return false;
}
// invalid permission
if (!in_multi_array($action.'-view', $permissions)) {
    if (in_multi_array($action, $permissions)) {
        if (strpos($action, 'manage') == 0) {
            require_once 'controller/' . $action . '.php';
        }
    }
    $action = 'home';
}
//view action
try {
    require_once 'controller/' . $action . '.php';
} catch (Exception $e) {
    throw $e;
}
