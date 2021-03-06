<?php
/**
 * @author Doriane Pott
 * @version 1.0.1 (2020/06/02) : can add multiple files, problem with move_uploaded_files solved
 * profile model page, will do the process with user's input, when his trying to add or update a resource,
 * and store the db's data for the display
 */

 $do = '';
 $do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
 if (read_user_by_email($_SESSION['email']) != false) {
    $education = read_user_by_email($_SESSION['email'])[0]['Id_Education'];
    $owner = read_user_by_email($_SESSION['email'])[0]['Id_User'];
 }
 if (read_resources_by_education($education, $owner) != false) {
    $resources = (read_resources_by_education($education, $owner));
    $own = (read_resources_by_education($education, $owner, true));
 }
 $name = "";
 $desc = "";
 $nm_module = '';
 $cd_module = '';
 $link = '';
 $msg = '';
 if ($education != NULL) {
    $nm_edu = read_education_by_id($education)[0]['Nm_Education'];
 } else {
     header('Location: index.php?action=home');
     exit();
 }

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
            //if first file exists
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
                            if (move_uploaded_file($files["tmp_name"][$i], $path.$filename) == TRUE && strlen($files['name'][$i]) <= 100) {
                                create_attachment($size, $mime, $files['name'][$i], $filename, $id_resource);
                                header('Location: ?action=profile');
                                exit();
                                
                            } else {
                                $error = "\n file error, please check that all files has a name below 100 characters, and retry";
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
     exit();
 }
 else if (stripos($do, 'delete') !== false) {
    $id = explode('-', $do);
    $id = $id[1];
     //delete the resource
     delete_resource($id);
     header('Location: ?action=profile');
     exit();
 } else if ($do == 'module') {
     $nm_module = filter_input(INPUT_POST, 'module', FILTER_SANITIZE_STRING);
     $cd_module = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
     $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
     if ($cd_module != '' && $nm_module != '' && $education != NULL && strlen($nm_module) <= 45 && strlen($cd_module) <= 5 && strlen($link) <= 200) {
        create_module($cd_module, $nm_module, $education, $link);
        header('Location: ?action=profile');
        exit();
     }else {
        $msg .= '<br/>please check, the size of your input';
     }
 }