<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/26)
 * model page
 */
session_start();
require_once 'model/crud_user.php';

$msg = '';

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$pwd   = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);
$btn   = filter_input(INPUT_POST, 'btnSubmit', FILTER_SANITIZE_STRING);

if ($btn == 'login') {
    $user = (read_user_by_email($email) == FALSE ? array() : read_user_by_email($email)[0]);
    var_dump($user);
    if ($user != array()) {
        $salt = $user['Txt_Password_Salt'];
        if (sha1($pwd . $salt) != $user['Txt_Password_Hash']) {
            $msg = 'email or wrong password.';
        } else {
            // get perm
            $role = get_user_role($user['Id_User']);
            // save session
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['logged'] = TRUE;

            header('Location: ?action=profil');
            exit();
        }
    } else {
        $msg = 'email or wrong password.';
    }
}


