<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/27)
 * crud page resources and attachments
 */

 #region resources
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
 
 /**
  * 
  */
 function read_own_resources_by_module($module, $id) {
    try {
        $bind = array(
            ':fk' => $module,
            ':id' => $id
        );
        $query = 'SELECT * FROM `Tbl_Resource` WHERE `Id_Module` = :fk AND `Id_User_Owner` = :id;';
        $db = connect();
        $query = $db->prepare($query);
        $query->execute($bind);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo $e->getMessage();
        return FALSE;
    }
 }

 
 function read_resources_by_education($education, $owner, $own = false) {
    $modules = read_module_by_education($education);
    $id = array();
    $resources = [];
    foreach ($modules as $record) {
        foreach ($record as $key => $value) {
            if ($key == 'Id_Module') {
                $id[] = $value;
            }
        }
    }
    foreach ($id as $value) {
        if ($own == true) {
            if (read_own_resources_by_module($value, $owner) != array()) {
                $resources[] = read_own_resources_by_module($value, $owner)[0];
            }
        } else {
            $resources[] = read_resource_by_module($value)[0];
        }
    }
    return ($resources);
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

 #endregion
 
 #region attachment

 #region CREATE

 /**
  * function to add a media
   */
  function create_attachment($nbBytes, $cdMime, $nameDisplay, $path, $fk){
    try {
        $date = date("Y-m-d H:i:s");
        $bind = array(
            ":type" => $cdMime,
            ":size" => $nbBytes,
            ":name" => $nameDisplay,
            ":path" => $path,
            ":fk" => $fk,
            ":date" => $date
        );
        $query = "INSERT INTO `Tbl_Attachment`(`Nb_Bytes`,`Cd_Mime_Type`, `Nm_Attachment`, `Dttm_Upload`, `Nm_File`,`Id_Resource`)
        VALUES (:size, :type, :name, :date, :path, :fk)";
        $db = connect();
        $query = $db->prepare($query);
        $query->execute($bind);
        return $db->lastInsertId();
    } catch (Exception $e) {
        $e->getMessage();
        return $e->getMessage();
    }
 }
 #endregion

 #region READ
 /**
  * @return array all record from Tbl_Attachment
  * @return false if error
  */
 function read_all_attachment() {
    try {
        $query = "SELECT * FROM `Tbl_Attachment`";
        $db = connect();
        $query = $db->prepare($query);
    
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $e){
        $e->getMessage();
    }
 }

 /**
  * @return array record
  * @return false if error
  */
 function read_attachment_by_id($id) {
    try {
        $bind = array(
            ':id' => $id
        );
        $query = "SELECT * FROM `Tbl_Attachment` WHERE `Id_Attachment` = :id";
        $db = connect();
        $query = $db->prepare($query);
    
        $query->execute($bind);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $e){
        $e->getMessage();
    }
 }

 function read_attachment_by_fk($fk) {
    try {
        $bind = array(
            ':fk' => $fk
        );
        $query = "SELECT * FROM `Tbl_Attachment` WHERE `Id_Resource` = :fk";
        $db = connect();
        $query = $db->prepare($query);
    
        $query->execute($bind);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $e){
        $e->getMessage();
    }
 }
 #endregion

 #region DELETE

 /**
  * @param int foreign key
  * @return bool false if error
  */
  function delete_attachment_by_fk($fk) {
    try {
        $bind = array(
            ':fk' => $fk
        );
        $query = "DELETE FROM `Tbl_Attachment` WHERE `Id_Resource` = :fk";
        $db = connect();
        $query = $db->prepare($query);
        $query->execute($bind);
        return TRUE;
    } catch(Exception $e){
        $e->getMessage();
        return FALSE;
    }
 }

 #endregion

 #endregion
 