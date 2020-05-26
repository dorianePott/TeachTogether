<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/26)
 * database connection page
 */
require_once 'const.php';

/**
 * Returns the PDO instance (and creates one if needed)
 * @return PDO
 */
function connect(){
    static $db = NULL;
    if ($db === NULL) {
        try{
            $str_connect = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
            $db = new PDO($str_connect, DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Unable to connect to the database (' . $e->getMessage() . ')');
        }
    }
    return $db;
}