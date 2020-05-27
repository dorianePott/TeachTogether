<?php
/**
 * crud page for user
 * @author Doriane Pott
 * @version 1.0 (2020/05/26)
 */
require_once 'database.php';

 #region Create

 /**
  * Inserts a row into the database.
  *
  * @param string first name
  * @param string last name
  * @param string email
  * @param string hash password
  * @param string salt password
  * @param string role
  *
  * @return int the inserted row ID
  */
 function create_user($first, $last, $email, $hash, $salt, $role = 'user') {
    try {
        $bind = array(
            ':first' => $first,
            ':last'  => $last,
            ':email' => $email,
            ':hash'  => $hash,
            ':salt'  => $salt,
            ':role'  => $role
        );
        $query = 'INSERT INTO `Tbl_User`(`Nm_First`, `Nm_Last`, `Txt_Email`, `Txt_Password_Hash`, `Txt_Password_Salt`, `Cd_Role`)
        VALUES (:first, :last, :email, :hash, :salt, :role);';
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
  * 
  */
 function read_all_user() {
    try {
        $query = 'SELECT * FROM `Tbl_User`';
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
  * Returns all unactivate user account
  * @return array unactivate user account
  */
 function read_user_unactivate(){
    try {
        $query = 'SELECT * FROM `Tbl_User` WHERE `Is_Active` = 0';
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
  * @param string email
  * @return array user record
  * @return false if error
  */
 function read_user_by_email($email){
     try {
         $bind = array(
            ':email' => $email
         );
         $query = 'SELECT * FROM `Tbl_User` WHERE `Txt_Email` = :email';
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
  * @param int user id
  * @return array perm
  * @return false if error
  */
 function read_user_perm($id) {
    try {
        $role = get_user_role($id)[0]['Cd_Role'];
        $bind = array(
            ':role' => $role
        );
        $query = 'SELECT `Cd_Permission` FROM `Tbl_Permission` WHERE `Cd_Role` = :role;';
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
  * @param int id user
  * @return array role
  * @return false if error
  */
 function get_user_role($id) {
    try {
        $bind = array(
            ':id' => $id
        );
        $query = 'SELECT `Cd_Role` FROM `TeachTogether`.`Tbl_User` WHERE `Id_User` = :id;';
        $db = connect();
        $query = $db->prepare($query);
        $query->execute($bind);
        return $query->fetchAll();
    } catch (Exception $e) {
        echo $e->getMessage();
        return FALSE;
    }
 }

 /**
  * 
  */
 function read_anonyme_perm() {
    try {
        $query = 'SELECT `Cd_Permission` FROM `Tbl_Permission` WHERE `Cd_Role` = "anonyme";';
        $db = connect();
        $query = $db->prepare($query);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo $e->getMessage();
        return FALSE;
    }
 }

 function get_anonyme_perm(){
     $perm = read_anonyme_perm();
     $out = array("Cd_Permission" => []);
     foreach ($perm as $record) {
         foreach ($record as $key => $value) {
             array_push($out['Cd_Permission'], $value);
         }
     }
     return $out;
 }

 /**
  * Returns all permissions
  * @return array all record from Tbl_Permission
  */
 function read_all_permission() {
    try {
        $query = 'SELECT * FROM `Tbl_Permission` ORDER BY `Cd_Role`';
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
  * Active a user
  * @param int id
  */
 function active_user($id) {
    try {
        $bind = array(
            ":id" =>  $id
        );
        $query = 'UPDATE `TeachTogether`.`Tbl_User` SET `Is_Active` = "1" WHERE (`Id_User` = :id);';   
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

 #region Delete
 #endregion

