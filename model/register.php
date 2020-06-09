<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/26)
 * registration logic here
 */
#region Init
$msg = '';
$do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
$salt = generate_salt();
#endregion


// verify input not null, then create user and quit
if ($do == 'register') {
     $first = filter_input(INPUT_POST, 'first', FILTER_SANITIZE_STRING);
     $last = filter_input(INPUT_POST, 'last', FILTER_SANITIZE_STRING);
     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
     $pwd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);
     $repwd = filter_input(INPUT_POST, 'repwd', FILTER_SANITIZE_STRING);
     $education = read_education_by_name(filter_input(INPUT_POST, 'Nm_Education', FILTER_SANITIZE_STRING))[0]['Id_Education'];
     #region Verify input
     if (check_name($first, 1, 45) == false || check_name($last, 1, 45) == false) {
         $msg = '<p>Verify that name and last name contens only letters 
         and make sure they contains less than 45 characters, and that they are not empty.</p>';
     } else {
         if (strlen($email) > 100) {
            $msg .= '<p>Your email contains more than 100 of characters.</p>';
         } else {
             if (sha1($pwd.$salt) != sha1($repwd.$salt)) {
                 $msg .= '<p>Passwords are different.</p>';
             } else {
                if (sha1($pwd.$salt) == sha1($repwd.$salt) && check_name($first, 1, 45) == true && check_name($last, 1, 45) 
                && $pwd != NULL && $repwd != NULL && $email != NULL) {
                    if(create_user($first, $last, $email, sha1($pwd . $salt), $salt, $education)){
                        header('Location: ?action=home');
                        exit();
                    } else {
                        $msg .= '<p>Database error, please retry later.</p>';
                    }
                } else {
                    $msg .= '<p>Check your input</p>';
                }
             }
         }
     }
     #endregion
    
}