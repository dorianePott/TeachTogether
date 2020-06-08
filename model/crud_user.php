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
 function create_user($first, $last, $email, $hash, $salt, $education, $role = 'user') {
    try {
        var_dump($role);
        $bind = array(
            ':first' => $first,
            ':last'  => $last,
            ':email' => $email,
            ':hash'  => $hash,
            ':salt'  => $salt,
            ':education' => $education,
            ':role'  => $role
        );
        $query = 'INSERT INTO `Tbl_User`(`Nm_First`, `Nm_Last`, `Txt_Email`, `Txt_Password_Hash`, `Txt_Password_Salt`, `Id_Education`, `Cd_Role`)
        VALUES (:first, :last, :email, :hash, :salt, :education, :role);';
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
        $query = 'SELECT `Id_User`,`Is_Active`, `Nm_First`, `Nm_Last`, `Txt_Email`, `Cd_Role`, `Id_Education` FROM `Tbl_User`';
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
  * @return array all permissions for anonymous user
  * @return false if error 
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
  * Activate a user
  * @param int id
  * @return bool false if error
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
        return TRUE;
    } catch (Exception $e) {
        echo $e->getMessage();
        return FALSE;
    }
 }

 /**
  * Deactivate a user
  * @param int id
  * @return bool false if error
  */
 function deactivate_user($id) {
    try {
        $bind = array(
            ":id" =>  $id
        );
        $query = 'UPDATE `TeachTogether`.`Tbl_User` SET `Is_Active` = "0" WHERE (`Id_User` = :id);';   
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
  * update a user
  * @param int user's id
  * @param string user's first name
  * @param string user's last name
  * @param string user's email
  * @param string path of user's avatar
  * @return bool false if error
  */
 function update_user_no_pwd($pwd, $first, $last, $email, $pic) {
    try {
        $bind = array(
            ":pwd" =>  $pwd,
            ':first' => $first,
            ':last' => $last,
            ':email' => $email,
            ':path' => $pic
        );
        $query = 'UPDATE `TeachTogether`.`Tbl_User`
        SET `Nm_First` = :first, `Nm_Last` = :last, `Txt_Email` = :email, `Nm_File_Profile_Picture` = :path WHERE (`Txt_Password_Hash` = :pwd);';   
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
  * update a user
  * @param int user's id
  * @param string user's first name
  * @param string user's last name
  * @param string user's email
  * @param string path of user's avatar
  * @return bool false if error
  */
 function update_user($pwd, $first, $last, $email, $pic, $newpwd) {
    try {
        $bind = array(
            ':first' => $first,
            ':last' => $last,
            ':email' => $email,
            ':path' => $pic,
            ':pwd' => $pwd,
            ':newpwd' => $newpwd
        );
        $query = 'UPDATE `TeachTogether`.`Tbl_User`
        SET `Nm_First` = :first, `Nm_Last` = :last, `Txt_Email` = :email, `Nm_File_Profile_Picture` = :path, `Txt_Password_Hash` = :newpwd WHERE (`Txt_Password_Hash` = :pwd);';   
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
