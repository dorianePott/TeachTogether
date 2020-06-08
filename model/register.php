<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/26)
 * registration logic here
 */
require_once 'model/crud_user.php';
#region Init
$msg = '';
$do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
#endregion

/**
 * @param int salt' length
 * @return string salt
 */
function generate_salt($length=20){
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $rndStr='';
    for ($i=0; $i < $length; $i++) { 
        $idx = rand(0,61);
        $char=$chars[$idx];
        $rndStr.=$char;
    }
    return $rndStr;
}

$salt = generate_salt();

// verify input not null, then create user and quit
if ($do == 'register') {
     $first = filter_input(INPUT_POST, 'first', FILTER_SANITIZE_STRING);
     $last = filter_input(INPUT_POST, 'last', FILTER_SANITIZE_STRING);
     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
     $pwd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);
     $repwd = filter_input(INPUT_POST, 'repwd', FILTER_SANITIZE_STRING);
     $education = read_education_by_name(filter_input(INPUT_POST, 'Nm_Education', FILTER_SANITIZE_STRING))[0]['Id_Education'];
    if (sha1($pwd.$salt) == sha1($repwd.$salt) && check_name($first, 1, 45) == true && check_name($last, 1, 45) 
        && $pwd != NULL && $repwd != NULL && $email != NULL) {
        create_user($first, $last, $email, sha1($pwd . $salt), $salt, $education);
        header('Location: ?action=home');
        exit();
    } else {
        $msg = 'error, please complete fields, and verify that name and last name contens only letters, and make sure there are under 45 characters.';

    }
    
}