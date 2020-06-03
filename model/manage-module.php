<?php
/**
 * @author Doriane Pott
 * @version 1.0.0 (2020-06-02) -> trying to make the select sticky
 * @todo make select sticky here
 */
 $code = '';
 $name = '';
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
      $code = read_module_by_id($id)[0]['Cd_Module'];
      $name = read_module_by_id($id)[0]['Nm_Module'];
      $education = read_module_by_id($id)[0]['Id_Education'];
      if ($btn == 'update') {
         $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
         $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
         $education = filter_input(INPUT_POST, 'Nm_Education', FILTER_SANITIZE_STRING);
         $education = read_education_by_name($education)[0]['Id_Education'];
         if ($code != '' && $name != '' && $education != NULL) {
            update_module($id, $code, $name, $education);
            $_SESSION['update'] = NULL;
         }
      }
   }
 }