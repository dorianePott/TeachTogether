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
         if ($values > MAX_FILE_SIZE) {
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

 function check_name($name, $dir) {
    $name = str_replace(' ', '', $name);
    $name = strtr($name, ACCENT, CORRECT_ACCENT);
    $inc = 1;
    $tmp = $name;
    while (file_exists($dir . $tmp)) {
        $tmp = explode('.', $name)[0] . $inc . '.' . explode('.', $name)[1];
        $inc++;
    }
    return $tmp;
 }