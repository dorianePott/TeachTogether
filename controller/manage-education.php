<?php
/**
 * controller page
 * class I.FA P3A
 * @author Pott Doriane
 * @version 1.0 (2020/05/26)
 */
if (!in_array('manage-education-view', $permissions[$role['Cd_Role']])){
    header('Location: ?action=home');
    exit();
}
require_once 'model/crud_education.php';
require_once 'model/manage-education.php';
require_once 'view/nav.php';
require_once 'view/manage-education.php';
