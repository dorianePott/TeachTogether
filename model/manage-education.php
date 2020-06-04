<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/27)
 * management page for educations
 */

 $name = filter_input(INPUT_POST, 'education', FILTER_SANITIZE_STRING);
 $btn = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);

 if ($name != NULL && $btn == 'create') {
    create_education($name);
 }
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
      $edu = read_education_by_id($id)[0];
      $name = $edu['Nm_Education'];
      $link = $edu['Txt_Education_Link'];
      
      if ($btn == 'update') {
         $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
         $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
         if ($name != '' && strlen($name) <= 100 && strlen($link) <= 200) {
            update_education($id, $name, $link);
            $_SESSION['update'] = NULL;
            header('Location: ?action=manage-education');
         } else {
            $msg .= 'check input size';
         }
      }
   }
 }