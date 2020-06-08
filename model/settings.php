<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020-06-03)
 * permit the user to update his profile in this page
 */

 $user = read_user_by_email($_SESSION['email'])[0];
 $first = $user['Nm_First'];
 $last = $user['Nm_Last'];
 $email = $user['Txt_Email'];
 $salt = $user['Txt_Password_Salt'];
 $pwd = '';
 $do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
 $error = '';

 if ($do == 'cancel') {
     header('Location: ?action=home');
     exit();
 } else if ($do == 'deactivate') {
     $id = $user['Id_User'];
     deactivate_user($id);
     header('Location: model/logout.php');
     exit();
 } else if ($do == 'confirm') {
     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
     $first = filter_input(INPUT_POST, 'first', FILTER_SANITIZE_STRING);
     $last = filter_input(INPUT_POST, 'last', FILTER_SANITIZE_STRING);
     $pwd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);
     $confirm = filter_input(INPUT_POST, 'confirm', FILTER_SANITIZE_STRING);
     $pic = '';
     $pwd = ($pwd != '') ? sha1($pwd.$salt) : '';
     $confirm = sha1($confirm.$salt);
     
     #region file
     if (isset($_FILES['avatar'])) {
        if(check_size($_FILES['avatar']['size'], false) == TRUE){
            $files = array();
            $files = $_FILES['avatar'];
            // if there's a file
            if ($files['error'] != 4) {
                $mime = mime_content_type($files['tmp_name']);
                $path = "user/";
                $filename = generate_name($files['name']);
                $size = $files['size'];
                //control that it's an image before uploading it, check the filename's length, and that the name is alphanumeric
                if (explode('/',$mime)[0] == 'image') {
                    if (move_uploaded_file($files["tmp_name"], $path.$filename) == TRUE) {
                        $pic = $path.$filename;
                    } else {
                        $error = "\n file error";
                    }
                } else {
                    $error ="<div class='text-danger'>verify that the file's an image, before uploading it.</div>";
                }
            }
        }
     }
     #endregion

     if ($pic == '') {
         $pic = $user['Nm_File_Profile_Picture'];
     }

     if ($confirm != '' && $pwd != '') {
        if ($confirm == $user['Txt_Password_Hash']) {
            update_user($confirm, $first, $last, $email, $pic, $pwd);
            $user = read_user_by_email($_SESSION['email'])[0];

            $perm = read_user_perm($user['Id_User']);
            // save session
            $_SESSION['email'] = $email;
            $_SESSION['permissions'] = $perm;
            $_SESSION['logged'] = TRUE;
            $_SESSION['avatar'] = $user['Nm_File_Profile_Picture'];
        } else {
            $error .= '<div class="alert alert-danger" role="alert">Incorrect password</div>';
        }
     }
     else if ($confirm != '') {
         if ($confirm == $user['Txt_Password_Hash']) {
            update_user_no_pwd($confirm, $first, $last, $email, $pic);
            $user = read_user_by_email($_SESSION['email'])[0];

            $perm = read_user_perm($user['Id_User']);
            // save session
            $_SESSION['email'] = $email;
            $_SESSION['permissions'] = $perm;
            $_SESSION['logged'] = TRUE;
            $_SESSION['avatar'] = $user['Nm_File_Profile_Picture'];

            header('Location: ?action=profile');
            exit();
         } else {
            $error .= '<div class="alert alert-danger" role="alert">Incorrect password</div>';
        }
     }
 }
 
