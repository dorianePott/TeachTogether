<?php
/**
 * @author Doriane Pott
 * @version 1.0.0 (2020-06-02) -> trying to make the select sticky
 */
 $code = '';
 $name = '';
 $msg = '';
 $education = NULL;
 $do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
 $id = (isset($_SESSION['update']) ? $_SESSION['update'] : NULL);
 if (stripos($do, 'update') !== false) {
     $id = explode("-", $do)[1];
     $_SESSION['update'] = $id;
 }
 if ($id != NULL) {
     //verify is exists, and use data from db
     if (read_module_by_id($id) !== false) {
      $btn = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_STRING);
      $module = read_module_by_id($id)[0];
      $code = $module['Cd_Module'];
      $name = $module['Nm_Module'];
      $link = $module['Txt_Module_Link'];
      $education = $module['Id_Education'];
      if ($btn == 'update') {
         $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
         $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
         $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
         $education = filter_input(INPUT_POST, 'Nm_Education', FILTER_SANITIZE_STRING);
         $education = read_education_by_name($education)[0]['Id_Education'];
         
         if ($code != '' && $name != '' && $education != NULL && strlen($name) <= 45 && strlen($code) <= 5 && strlen($link) <= 200) {
            update_module($id, $code, $name, $link, $education);
            $_SESSION['update'] = NULL;
            header('Location: ?action=manage-module');
         }
      }
   }
 }