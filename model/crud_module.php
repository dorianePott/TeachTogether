<?php
/**
 * @author Pott Doriane
 * @version 1.0 (2020/05/27)
 * @todo update_education() { }
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

 
 /**
  * Create a brand new education
  * @param string name
  * @param string link
  * @return int last id
  * @return false if error
  */
 function create_education($name, $link = '/'){
    try {
        if ($link == '/') {
            $link = $name .'/';
        }
        $bind = array(
            ':name' => $name,
            ':link' => $link
        );
        $query = 'INSERT INTO `Tbl_Education`(`Nm_Education`, `Txt_Education_Link`)
        VALUES (:name, :link);';
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

 /**
  * @param int id
  * @return array record
  * @return false if error
  */
 function read_module_by_id($id){
    try {
        $bind = array(
            ':id' => $id
        );
        $query = 'SELECT * FROM `Tbl_Module` WHERE `Id_Module` = :id';
        $db = connect();
        $query = $db->prepare($query);
        $query->execute($bind);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo $e->getMessage();
        return FALSE;
    }
 }

 function read_module_by_code($code) {
    try {
        $bind = array(
            ':code' => $code
        );
        $query = 'SELECT * FROM `Tbl_Module` WHERE `Cd_Module` = :code';
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
 function read_module_by_education($fk) {
    try {
        $bind = array(
            ':fk' => $fk
        );
        $query = 'SELECT * FROM `Tbl_Module` WHERE `Id_Education` = :fk';
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
  * @return array all record
  * @return false if error
  */
 function read_all_education() {
    try {
        $query = 'SELECT * FROM `Tbl_Education`';
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
  * @param string name
  * @return array record
  * @return false if error
  */
 function read_education_by_name($name) {
    try {
        $bind = array(
            ':name' => $name
        );
        $query = 'SELECT * FROM `Tbl_Education` WHERE `Nm_Education` = :name';
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
  * @param int id
  * @param string code
  * @param string name
  * @param int fk
  * @return bool false if error
  */
 function update_module($id, $code, $name, $fk) {
    try {
        $bind = array(
            ':name' => $name,
            ':id' => $id,
            ':code' => $code,
            ':fk' => $fk
        );
        $query = 'UPDATE `TeachTogether`.`Tbl_Module` SET `Cd_Module` = :code, `Nm_Module` = :name, `Id_Education` = :fk WHERE (`Id_Module` = :id);';
        $db = connect();
        $query = $db->prepare($query);
        $query->execute($bind);
        return TRUE;
    } catch (Exception $e) {
        echo $e->getMessage();
        return FALSE;
    }
 }
 /**
  * @todo update_education(){ }
  */
 #endregion

 #region Delete
 #endregion

