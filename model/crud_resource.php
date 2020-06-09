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
 function read_all_resources() {
    try {
        $resources = array();
        $query = 'SELECT * FROM `Tbl_Resource`';
        $db = connect();
        $query = $db->prepare($query);
        $query->execute();
        $records = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            if (read_attachment_by_fk($record['Id_Resource']) != array()) {
                $record['media'] = read_attachment_by_fk($record['Id_Resource']);
            } else {
                $record['media'] = array();
            }
            $resources[] = $record;
        }
        return $resources;
    } catch (Exception $e) {
        echo $e->getMessage();
        return FALSE;
    }
 }

 /**
  * @return array all undeleted record
  * @return false if error
  */
 function read_undeleted_resources() {
    try {
        $resources = array();
        $query = 'SELECT * FROM `Tbl_Resource` WHERE `Is_Deleted` = 0;';
        $db = connect();
        $query = $db->prepare($query);
        $query->execute();
        $records = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            if (read_attachment_by_fk($record['Id_Resource']) != array()) {
                $record['media'] = read_attachment_by_fk($record['Id_Resource']);
            } else {
                $record['media'] = array();
            }
            $resources[] = $record;
        }
        return $resources;
    } catch (Exception $e) {
        echo $e->getMessage();
        return FALSE;
    }
 }

 /**
  * get all informations linked to the specified resource
  * @param int resource's id
  * @return array all data
  */
 function read_resource_by_id($id) {
    try {
        $bind = array(
            ':id' => $id
        );
        $resources = array();
        $query = 'SELECT * FROM `Tbl_Resource` WHERE `Id_Resource` = :id';
        $db = connect();
        $query = $db->prepare($query);
        $query->execute($bind);
        $records = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            if (read_attachment_by_fk($id) != array()) {
                $record['media'] = read_attachment_by_fk($id);
            } else {
                $record['media'] = array();
            }
            $resources[] = $record;
        }
        return ($resources);
    } catch (Exception $e) {
        echo $e->getMessage();
        return FALSE;
    }
 }

 /**
  * read all record for a specified module, but not the deleted one
  * @param int fk from Tbl_Module
  * @return array record
  * @return false if error
  */
 function read_resource_by_module($module) {
    try {
        $bind = array(
            ':fk' => $module
        );
        $query = 'SELECT * FROM `Tbl_Resource` WHERE `Id_Module` = :fk AND `Is_Deleted` = 0';
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
        $query = 'SELECT * FROM `Tbl_Resource` WHERE `Id_Module` = :fk AND `Id_User_Owner` = :id AND `Is_Deleted` = 0;';
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
                $values = read_own_resources_by_module($value, $owner);
                foreach ($values as $record) {
                    $resources[] = $record;
                }
            }
        } else {
            $records = read_resource_by_module($value);
            foreach ($records as $record) {
                if (read_attachment_by_fk($record['Id_Resource']) != array()) {
                    $record['media'] = read_attachment_by_fk($record['Id_Resource']);
                } else {
                    $record['media'] = array();
                }
                $resources[] = $record;
            }
        }
    }
    return ($resources);
}
 #endregion
 
 #region Update

 /**
  * update a resource
  * @param int resource's id
  * @param string resource's name
  * @param string resource's link
  * @return bool false if error
  */
 function update_resource($id, $name, $desc, $fk) {
    try {
        $bind = array(
            ':name' => $name,
            ':id' => $id,
            ':desc' => $desc,
            ':fk' => $fk
        );
        $query = 'UPDATE `TeachTogether`.`Tbl_Resource` 
        SET `Txt_Description` = :desc, `Nm_Resource` = :name, `Id_Module` = :fk WHERE (`Id_Resource` = :id);';
        $db = connect();
        $query = $db->prepare($query);
        $query->execute($bind);
        return TRUE;
    } catch (Exception $e) {
        echo $e->getMessage();
        return FALSE;
    }
 }

 #endregion

 #region Delete
 /**
  * Deactivate the resource, and all the attachments link to it
  * @param int resource's id
  * @return bool false if error
  */
 function delete_resource($id_resource) {
     try {
         // read resource
        $record = read_resource_by_id($id_resource)[0];
        $media = $record['media'];
        // if resource has media, del media
        if ($media != array()) {
            delete_attachment_by_fk($id_resource);
        }

        //delete resource
        $bind = array(
            ':id' => $id_resource
        );
        $query = "UPDATE `TeachTogether`.`Tbl_Resource` SET `Is_Deleted` = '1' WHERE `Id_Resource` = :id";
        $db = connect();
        $query = $db->prepare($query);
        $query->execute($bind);
        return TRUE;
    } catch(Exception $e){
        $e->getMessage();
        return FALSE;
    }
 }

 /**
  * Activate the resource, and all the attachements link to it
  * @param int resource's id
  * @return bool false if error
  */
 function activate_resource($id_resource) {
    try {
        // read resource
       $record = read_resource_by_id($id_resource)[0];
       $media = $record['media'];
       // if resource has media, del media
       if ($media != array()) {
           activate_attachment_by_fk($id_resource);
       }

       //delete resource
       $bind = array(
           ':id' => $id_resource
       );
       $query = "UPDATE `TeachTogether`.`Tbl_Resource` SET `Is_Deleted` = '0' WHERE `Id_Resource` = :id";
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
  * @param int attachement identifier
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

 /**
  * @param int identifier from the resource
  * @return array record
  * @return false if error
  */
 function read_attachment_by_fk($fk) {
    try {
        $bind = array(
            ':fk' => $fk
        );
        $query = "SELECT * FROM `Tbl_Attachment` WHERE `Id_Resource` = :fk AND `Is_Deleted`=0";
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
        $query = "UPDATE `TeachTogether`.`Tbl_Attachment` SET `Is_Deleted` = '1' WHERE `Id_Resource` = :fk";
        $db = connect();
        $query = $db->prepare($query);
        $query->execute($bind);
        return TRUE;
    } catch(Exception $e){
        $e->getMessage();
        return FALSE;
    }
 }

 /**
  * @param int attachment's id
  * @return bool false if error
   */
 function delete_attachment_by_id($id) {
    try {
        $bind = array(
            ':id' => $id
        );
        $query = "UPDATE `Tbl_Attachment` SET `Is_Deleted` = '1' WHERE `Id_Attachment` = :id";
        $db = connect();
        $query = $db->prepare($query);
        $query->execute($bind);
        return TRUE;
    } catch(Exception $e){
        $e->getMessage();
        return FALSE;
    }
 }

 /**
  * Reactivate an attachments linked to a given education
  * @param int resource's id
  * @return bool false if error
  */
 function activate_attachment_by_fk($fk) {
    try {
        $bind = array(
            ':fk' => $fk
        );
        $query = "UPDATE `TeachTogether`.`Tbl_Attachment` SET `Is_Deleted` = '0' WHERE `Id_Resource` = :fk";
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
 