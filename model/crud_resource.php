<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/27)
 * crud page
 */

 #region Create
 /**
  * Create a brand new education
  * @param string name
  * @param string link
  * @return int last id
  * @return false if error
  */
 function create_resource($name, $desc, $owner, $module ){
    try {
        $date = date("Y-m-d H:i:s");
        $bind = array(
            ':name' => $name,
            ':date' => $date,
            ':desc' => $desc,
            ':owner' => $owner,
            ':module' => $module
        );
        $query = 'INSERT INTO `Tbl_Resource`(`Dttm_Creation`, `Dttm_Last_Update`, `Nm_Resource`, `Txt_Description`, `Id_User_Owner`, `Id_Module`)
        VALUES (:date, :date, :name, :desc, :owner, :module);';
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
 function read_all_resource() {
    try {
        $query = 'SELECT * FROM `Tbl_Resource`';
        $db = connect();
        $query = $db->prepare($query);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo $e->getMessage();
        return FALSE;
    }
 }

 /**
  * @param int fk from Tbl_Module
  * @return array record
  * @return false if error
  */
 function read_resource_by_module($module) {
    try {
        $bind = array(
            ':fk' => $module
        );
        $query = 'SELECT * FROM `Tbl_Resource` WHERE `Id_Module` = :fk';
        $db = connect();
        $query = $db->prepare($query);
        $query->execute($bind);
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
 function update_resource($id, $name, $link) {
     //
 }
 #endregion
