<?php
/**
 * @author Doriane Pott
 * @version 1.0.1 (2020/06/02) : can add multiple files, problem with move_uploaded_files solved
 * model page
 */

 $do = '';
 $do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
 $education = read_user_by_email($_SESSION['email'])[0]['Id_Education'];
 $owner = read_user_by_email($_SESSION['email'])[0]['Id_User'];
 $resources = (read_resources_by_education($education, $owner));
 $own = (read_resources_by_education($education, $owner, true));
 $name = "";
 $desc = "";

 if ($do == 'create') {
     #name desc upload[]
     $date = date("Y-m-d H:i:s");
     $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
     $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
     $module = filter_input(INPUT_POST, 'Cd_Module', FILTER_SANITIZE_STRING);
     $count_files = (isset($_FILES['upload']['name'])) ? count($_FILES['upload']['name']) : 0;
     $module = read_module_by_code($module)[0]['Id_Module'];
     $id_resource = create_resource($name.'___'.$date, $desc, $owner, $module);
     #region file
     if (isset($_FILES['upload'])) {
        if(check_size($_FILES['upload']['size']) == TRUE && $count_files > 0){
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
                            create_attachment($size, $mime, $files['name'][$i], $filename, $id_resource);
                        } else {
                            $error = "\n file error";
                        }
                    }
                }
            }
        }
     }
     #endregion
 }
 else if (stripos($do, 'update') !== false) {
     $id = explode('-', $do);
     $id = $id[1];
     $_SESSION['to_update'] = $id;
     header('Location: ?action=update');
     exit;
 }
 else if (stripos($do, 'delete') !== false) {
    $id = explode('-', $do);
    $id = $id[1];
     //delete the resource
     delete_resource($id);
 }