<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/26)
 * model page
 */

$msg = '';

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$pwd   = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);
$btn   = filter_input(INPUT_POST, 'btnSubmit', FILTER_SANITIZE_STRING);

if ($btn == 'login') {
    $user = (read_user_by_email($email) == FALSE ? array() : read_user_by_email($email)[0]);
    
    if (isset($user['Id_User'])) {

        $salt = $user['Txt_Password_Salt'];
        if (sha1($pwd . $salt) != $user['Txt_Password_Hash']) {
            $msg = 'email or wrong password.';
        }
        else if ($user['Is_Active'] == 0){
            $msg = 'please wait until your account is validate by an admin';
        }
         else {
            // get perm
            $perm = read_user_perm($user['Id_User']);
            var_dump($perm);
            // save session
            $_SESSION['email'] = $email;
            $_SESSION['permissions'] = $perm;
            $_SESSION['logged'] = TRUE;

            header('Location: ?action=profile');
            exit();
        }
    } else {
        $msg = 'email or wrong password.';
    }
}


