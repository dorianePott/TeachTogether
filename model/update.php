<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020-06-03)
 * page to update resources
 * @todo verify also here that the user need to have the permission, to update it, in case of force the url
 */
 $id = $_SESSION['to_update'];
 $do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
 $name = "";
 $desc = "";
 $code = "";
 $education = read_user_by_email($_SESSION['email'])[0]['Id_Education'];
 $owner = read_user_by_email($_SESSION['email'])[0]['Id_User'];
 $media = array();
 $record = read_resource_by_id($id);
 //test if record exists in table
 if($record !== FALSE && $record != array()) {
    //get values from record
     $name = $record[0]['Nm_Resource'];
     $desc = $record[0]['Txt_Description'];
     $code = $record[0]['Id_Module'];
     $code = read_module_by_id($code)[0]['Cd_Module'];
     $media = $record[0]['media'];
 }
 //update only if name and desc != NULL
 if ($do == 'update' && $name != "" && $desc != "") {
     $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
     $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
     $code = filter_input(INPUT_POST, 'Cd_Module', FILTER_SANITIZE_STRING);
     $code = read_module_by_code($code)[0]['Id_Module'];
     $count_files = (isset($_FILES['upload']['name'])) ? count($_FILES['upload']['name']) : 0;
     //if add attachments
     #region file
     if(check_size($_FILES['upload']['size']) == TRUE && $count_files > 0){
         echo'adding in progress..'; 
         $files = array();
         $files = $_FILES['upload'];
         if ($files['error'][0] != 4) {
             //verify that there's file(s)
             if ($count_files > 0) {
                 // do action for each file
                 for ($i=0; $i < $count_files; $i++) {
                     if ($files['error'][$i] == UPLOAD_ERR_NO_FILE) {
                         echo "Please, select file to upload";
                     }
                     $mime = mime_content_type($files['tmp_name'][$i]);
                     $path = DEFAULT_DIR;
                     $filename = generate_name($files['name'][$i]);
                     $size = $files['size'][$i];
                     if (move_uploaded_file($files["tmp_name"][$i], $path.$filename) == TRUE) {
                         create_attachment($size, $mime, $files['name'][$i], $filename, $id);
                     } else {
                         $error = "\n file error";
                     }
                 }
             }
         }
     }
     #endregion
     update_resource($id, $desc, $name, $code);
     header("Location: ?action=profile");
     exit();
 }
 //delete attachment
 else if(stripos($do, 'delete') !== FALSE) {
    $attachment = explode('-', $do);
    $attachment = $attachment[1];
    if(delete_attachment_by_id($attachment)){
        header("Location: ?action=update");
        exit();
    }
 }
