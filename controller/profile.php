<?php
/**
 * controller page
 * class I.FA P3A
 * @author Pott Doriane
 * @version 1.0 (2020/05/26)
 */
require_once 'model/crud_user.php';
//if not connected
if (in_array('logout-view', $permissions[$role['Cd_Role']])) {
    //if invalid user
    if(read_user_by_email($_SESSION['email']) == FALSE){
        header('Location: ?action=home');
        exit();
    }
}
require_once 'model/profile.php';
require_once 'view/nav.php';
require_once 'view/profile.php';
