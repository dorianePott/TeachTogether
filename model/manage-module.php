<?php
/**
 * @author Doriane Pott
 * @version 1.0.0
 * Management page for modules
 */
 if (read_all_education() == false) {
    echo <<<NOEDUCATION
    <div class="alert alert-danger">No education, please create one before doing anything</div>
NOEDUCATION;
 } else {
 $code = '';
 $name = '';
 $msg = '';
 $education = NULL;
 $do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
 $id = (isset($_SESSION['update']) ? $_SESSION['update'] : NULL);
 $btn = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_STRING);

 if (stripos($do, 'update') !== false) {
     $id = explode("-", $do)[1];
     $_SESSION['update'] = $id;
 }

 if ($id != NULL) {
     //verify is exists, and use data from db
     if (read_module_by_id($id) !== false) {
      $module = read_module_by_id($id)[0];
      $code = $module['Cd_Module'];
      $name = $module['Nm_Module'];
      $link = $module['Txt_Module_Link'];
      $education = $module['Id_Education'];
   }
 }
 if ($btn != '') {
   $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
   $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
   $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
   $education = filter_input(INPUT_POST, 'Nm_Education', FILTER_SANITIZE_STRING);
   $education = read_education_by_name($education)[0]['Id_Education'];
   
   if ($code != '' && $name != '' && $education != NULL && strlen($name) <= 45 && strlen($code) <= 5 && strlen($link) <= 200) {
      if ($btn == 'create') {
         create_module($code, $name, $education, $link);
         header('Location: ?action=manage-module');
      } else if ($btn == 'update') {
         update_module($id, $code, $name, $link, $education);
         $_SESSION['update'] = NULL;
         header('Location: ?action=manage-module');
      } else{
         $msg .= 'Error with the server, please retry later<br/>';
      }
   } else {
      $msg .= 'Please check, the size of your input, and make sure that you have selected an education.';
   }
}
}