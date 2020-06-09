<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/26)
 * registration logic here
 */
#region Init
$msg = '';
$do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
#endregion

$salt = generate_salt();

// verify input not null, then create user and quit
if ($do == 'register') {
     $first = filter_input(INPUT_POST, 'first', FILTER_SANITIZE_STRING);
     $last = filter_input(INPUT_POST, 'last', FILTER_SANITIZE_STRING);
     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
     $pwd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);
     $repwd = filter_input(INPUT_POST, 'repwd', FILTER_SANITIZE_STRING);
     $education = read_education_by_name(filter_input(INPUT_POST, 'Nm_Education', FILTER_SANITIZE_STRING))[0]['Id_Education'];
     if (check_name($first, 1, 45) == false || check_name($last, 1, 45) == false) {
         $msg = '<div class="alert alert-danger">
         <p>Verify that name and last name contens only letters 
         and make sure they contains less than 45 characters, and that they are not empty.</p>
         </div>';
     } else {
         if (strlen($email) > 100) {
            $msg .= '
            <p>Your email contains more than 100 of characters.</p>
            ';
         } else {
             if (sha1($pwd.$salt) != sha1($repwd.$salt) || $pwd == NULL && $repwd == NULL) {
                 echo 'pwd';
                 $msg .= '<p>
                 Passwords are different, or empty.
                 </p>';
                 var_dump($msg);
             } else {
                if (sha1($pwd.$salt) == sha1($repwd.$salt) && check_name($first, 1, 45) == true && check_name($last, 1, 45) 
                && $pwd != NULL && $repwd != NULL && $email != NULL) {
                    if(create_user($first, $last, $email, sha1($pwd . $salt), $salt, $education)){
                        header('Location: ?action=home');
                        exit();
                    } else {
                        echo 'db';
                        $msg .= '<div class="alert alert-danger">Database error, please retry later.</div>';
                    }
                } else {
                    echo 'error';
                    $msg .= '<div class="alert alert-danger"><p>Make sure the password is the same</p><p>error, please complete fields</p> <p>Verify that name and last name contens only letters and make sure there are under 45 characters.</p></div>';
                }
             }
         }
     }
    
}