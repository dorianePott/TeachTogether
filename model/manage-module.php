<?php
/**
 * 
 */
 $code = '';
 $name = '';
 $education = NULL;
 $do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
 if (stripos($do, 'update') !== false) {
     $id = explode("-", $do)[1];
     $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
     $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
     $education = filter_input(INPUT_POST, 'education', FILTER_SANITIZE_NUMBER_INT);

     if ($code != '' && $name != '' && $education != NULL) {
        update_module($id, $code, $name, $education);
     }
}