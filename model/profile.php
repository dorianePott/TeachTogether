<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/26)
 * model page
 */

 //get module from user
 //get id owner from user
 $do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);
 //
 $education = read_user_by_email($_SESSION['email'])[0]['Id_Education'];
 $id = read_user_by_email($_SESSION['email'])[0]['Id_User'];

 $resources = (read_resources_by_education($education, $id));
 $own = (read_resources_by_education($education, $id, true));
