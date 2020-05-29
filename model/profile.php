<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/26)
 * model page
 */

 define('DEFAULT_DIR', 'storage/');

 $do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
 
 $education = read_user_by_email($_SESSION['email'])[0]['Id_Education'];
 $owner = read_user_by_email($_SESSION['email'])[0]['Id_User'];
 $resources = (read_resources_by_education($education, $owner));
 $own = (read_resources_by_education($education, $owner, true));

 if ($do == 'create') {
     # code... name desc upload[]
     $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
     $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
     $module = filter_input(INPUT_POST, 'Cd_Module', FILTER_SANITIZE_STRING);
     $count_files = (isset($_FILES['upload']['name'])) ? count($_FILES['upload']['name']) : 0;
     $module = read_module_by_code($module)[0]['Id_Module'];
     $id_resource = create_resource($name, $desc, $owner, $module);
     #region file
     if ($_FILES['upload']['error'][0] = 4) {
        if(check_size($_FILES['upload']['size']) == TRUE && $count_files > 0){
            $files = array();
            $files = $_FILES['upload'];
            $name .= date("Y-m-d H:i:s");
            if ($id_resource > 0) {
                //verify that there's file(s)
                if ($count_files > 0) {
                    // do action for each file
                    for ($i=0; $i < $count_files; $i++) {
                        $mime = mime_content_type($files['tmp_name'][$i]);
                        $path = DEFAULT_DIR;
                        $filename = generate_name($files['name'][$i]);
                        $size = $files['size'][$i];
                        var_dump(move_uploaded_file($filename, $path.$filename));
                        if (move_uploaded_file($filename, $path.$filename) == TRUE) {
                            create_attachment($size, $mime, $files['name'][$i], $filename, $id_resource);
                        } else {
                            $error = "\n cannot add data in db";
                        }
                    }
                }
            }
        }
     }
     
     #endregion
 }