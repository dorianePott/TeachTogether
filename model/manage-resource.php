<?php
/**
 * @author Doriane Pott
 * @version 1.1 (2020-06-02) -> managing logic here
 */
 $do = '';
 $do = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);


 if (stripos($do, 'update') !== false) {
    $id = explode('-', $do);
    $id = $id[1];
    $_SESSION['to_update'] = $id;
    header('Location: ?action=update');
    exit();
}
 else if (stripos($do, 'deactivate') !== false) {
    $id = explode('-', $do);
    $id = $id[1];
    //delete the resource
    delete_resource($id);
 }
 else if (stripos($do, 'activate') !== false) {
    $id = explode('-', $do);
    $id = $id[1];
    //reactivate a resource
    activate_resource($id);
 }