<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020-05-25)
 * const
 */

#region database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'TeachTogether');
define('DB_USER', 'teacher');
define('DB_PASS', 'Super');
#endregion

#region const for function
define('IS_ACTIVATE', 'active' );
define('IS_DELETED', 'deleted');

define('DEFAULT_DIR', 'storage/');
define('MAX_FILE_SIZE', 5242880);  //5MB
define('MAX_RESOURCE_SIZE', 73400320); //70MB
define('ACCENT', 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ');
define('CORRECT_ACCENT', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
#endregion
