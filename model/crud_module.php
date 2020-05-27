<?php
/**
 * @author Pott Doriane
 * @version 1.0 (2020/05/27)
 */

 #region Create
 /**
  * @param string code
  * @param string name
  * @param int foreign key from education
  * @param string ICT link
  */
 function create_module($code, $name, $fk, $link = '') {
    try {
        $bind = array(
            ':code' => $code,
            ':name'  => $name,
            ':link' => $link,
            ':fk' => $fk
        );
        $query = 'INSERT INTO `Tbl_Module`(`Cd_Module`, `Nm_Module`, `Txt_Module_Link`, `Id_Education`)
        VALUES (:code, :name, :link, :fk);';
        $db = connect();
        $query = $db->prepare($query);
        $query->execute($bind);
        return $db->lastInsertId();
    } catch (Exception $e) {
        echo $e->getMessage();
        return FALSE;
    }
 }
 #endregion

 #region Read
 /**
  * @return array all record
  * @return false if error
  */
 function read_all_module() {
    try {
        $query = 'SELECT * FROM `Tbl_Module`';
        $db = connect();
        $query = $db->prepare($query);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo $e->getMessage();
        return FALSE;
    }
 }
 #endregion

 #region Update
 /**
  * 
  */
 function update_module($id) {
     try {
         //code...
     } catch (\Throwable $th) {
         //throw $th;
     }
 }
 #endregion

 #region Delete
 #endregion

 #region Display
 function display_modules(){
     $data = read_all_module();
     $out = '';
 }
 #endregion
