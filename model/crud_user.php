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
 function create($first, $last, $email, $hash, $salt, $role = 'user') {
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
 function read_all() {

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
 #endregion

 #region Delete
 #endregion

 #region Display
 function permissions_by_role(){
    $permission = read_all_permission();
    $result = array();
    $roles = array();
    foreach ($permission as $record) {
        foreach ($record as $key => $value) {
            if($key == 'Cd_Permission') {
                $tmp = $value;
            }
            if($key == 'Cd_Role') {
                if (!isset($result[$value]) || $result[$value] == NULL) {
                    $result[$value] = [$tmp];
                }
                array_push($result[$value], $tmp);
            }
    
        }
    }
    return $result;
 }
 #endregion
