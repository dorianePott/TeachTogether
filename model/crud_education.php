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
 #endregion

 #region Delete
 #endregion

 #region Display
 #endregion
