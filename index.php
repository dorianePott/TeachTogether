<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020-05-25)
 * index page
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

$role = 'anonyme';

$permission; # = db perm' data

if (!array_key_exists($action, $permission[$role])) {
    $action = 'default';
}


try {
    require './controller/' . $permission[$role][$action] . '.php';
} catch (\Exception $e) {
    throw $e;
}