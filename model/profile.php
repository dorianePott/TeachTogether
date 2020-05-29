<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/26)
 * model page
 */

 define('DEFAULT_DIR', './storage/');
 $do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
 //
 $education = read_user_by_email($_SESSION['email'])[0]['Id_Education'];
 $owner = read_user_by_email($_SESSION['email'])[0]['Id_User'];

 $resources = (read_resources_by_education($education, $owner));
 $own = (read_resources_by_education($education, $owner, true));


 if ($do == 'create') {
     # code... name desc upload[]
     $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
     $name = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
     $module = filter_input(INPUT_POST, 'Cd_Module', FILTER_SANITIZE_STRING);
     $files = $_FILES;
     $count_files = count($files['upload']['name']);
     #region verify
     if(check_size($files['upload']['size']) == TRUE){
        $name .= date("Y-m-d H:i:s");
        $id_resource = create_resource($name, $desc, $owner, $module);
        if ($id_resource > 0) {
            //verify that there's file(s)
            if ($count_files > 0) {
                for ($i=0; $i < $count_files; $i++) { 
                    $mime = mime_content_type($files['upload']['tmp_name'][$i]);
                    $type = explode('/', $mime)[0]; //mime format [ext/type]
                    $path = DEFAULT_DIR . $type . '/';
                }
                $filename = check_name($files['upload']['tmp_name'][$i], $path);
                $path = $path . $filename;
            }
        }
     }
     #endregion
 }