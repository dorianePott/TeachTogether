<?php
/**
 * controller page
 * class I.FA P3A
 * @author Pott Doriane
 * @version 1.0 (2020/05/26)
 */
if (!in_array('manage-user-view', $permissions[$role['Cd_Role']])){
    header('Location: ?action=home');
    exit();
}
require_once 'model/manage-user.php';
require_once 'model/crud_user.php';
require_once 'view/nav.php';
require_once 'view/manage-user.php';
