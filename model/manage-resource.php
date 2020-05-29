<?php
/**
 * 
 */

 define('MAX_FILE_SIZE', 4194304);  //4MB
 define('MAX_RESOURCE_SIZE', 73400320); //70MB
 define('ACCENT', 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ');
 define('CORRECT_ACCENT', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

 function check_size($files) {
     $total = 0;
     foreach ($files as $key => $value) {
         if ($value > MAX_FILE_SIZE) {
             return FALSE;
         } else {
             $total += $value;
         }
     }
     if ($total > MAX_RESOURCE_SIZE) {
         return FALSE;
     }
     return TRUE;
 }

 function generate_name($name) {
    return md5($name . uniqid() . date('Y-m-d H:i:s')).".".explode('.', $name)[1];
 }