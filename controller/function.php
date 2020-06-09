<?php
/**
 * @author Doriane Pott
 * @version 1.0
 * page for displaying and check file functions
 */

require_once 'model/const.php';

/**
 * will check the size of all file
 * @param array files
 * @return bool false if error in file's size
 */
function check_size($files, $array = true) {
    $total = 0;
    if ($array == true) {
      foreach ($files as $key => $value) {
          if ($value > MAX_FILE_SIZE) {
              return FALSE;
          } else {
              $total += $value;
          }
      }
      if ($total > MAX_RESOURCE_SIZE) {
          return FALSE;
      }
      return TRUE;
    } else {
      if ($files > MAX_FILE_SIZE) {
        return FALSE;
      } else {
        return TRUE;
      }
    }
}

/**
 * will generate a unique name
 * @param string actual name of the resource
 * @return string a brand new name
 */
function generate_name($name) {
   return md5($name . uniqid() . date('Y-m-d H:i:s')).".".explode('.', $name)[1];
}

/**
 * function that will display the table as an html table
 * @param array table's data
 * @param string index
 * @param bool has the possibility to update
 * @param bool has the possibility to activate things
 * @param bool has the possibility to delete record
 * @return string html table
 */
function display_table($table, $idx, $has_update = false, $has_activation = false, $has_delete = false){
    if ($table == NULL) {
      return false;
    }
    $table['data'] = $table;
    $table['column'] = current($table);
    $out = '<nav class="card" style="overflow: auto; height:50%;">    ';  // the return value
    $nb_col = 0;  // the number of max column
    $count = 0; // count the actual column
    $id = 0; // actual index
    $fields_name[] = $table['column'];  // contains the schema's columns

    #region header
    $out .= '<table class="table table-sm table-light table-hover" style="height:30%; overflow: auto; "><caption>List of data</caption>';
    $out .= '<thead class="thead thead-dark"><tr>';
    // cross the different column to get there name to display them later
    foreach ($fields_name as $col) {
      foreach ($col as $key => $value) {
        $out .= '<th col-4>'.$key.'</th>';
        $nb_col++;
      }
    }
    $out .= (($has_update) ? '<th>Update</th>' : '');
    $out .= '</tr></thead>';
    #endregion
    #region data
    foreach ($table['data'] as $record) {
      foreach ($record as $key => $value) {
        // check if index and add index at the <td>
        if (stripos($key, $idx) !== false) {
          $id = $value;
        }
        if (stripos($key, IS_DELETED) !== false) {
          if ($value == 1) {
            $out .= sprintf(($has_activation) ? '<td><button type="submit" class="btn btn-outline-secondary" value="activate-%d" name="do">Activate</button></td>' : '', $id);
          } else {
            $out .= sprintf(($has_activation) ? '<td><button type="submit" class="btn btn-outline-secondary" value="deactivate-%d" name="do">Deactivate</button></td>' : '', $id);
          }
        } else if( stripos($key, IS_ACTIVATE) !== false){
          if ($value == 0) {
            $out .= sprintf(($has_activation) ? '<td><button type="submit" class="btn btn-outline-secondary" value="activate-%d" name="do">Activate</button></td>' : '', $id);
          } else {
            $out .= sprintf(($has_activation) ? '<td><button type="submit" class="btn btn-outline-secondary" value="deactivate-%d" name="do">Deactivate</button></td>' : '', $id);
          }
        } else {
          $out .= sprintf('<td id="%s">%s</td>', $id, $value);
        }
        // at the final column, will display option of deletion and update
        if ($count == $nb_col - 1) {
            $out .= sprintf(($has_delete) ? '<td class="col-4"><button type="submit" class="btn btn-outline-secondary" value="delete-%d" name="do">Delete</button></td>' : '', $id) 
            . sprintf(($has_update) ? '<td class="col-4"><button type="submit" class="btn btn-outline-secondary" value="update-%d" name="do">Update</button></td>' : '', $id);
            $count = 0;
        } else {
          $count++;
        }
      }
      $out .= '</tr>';
    }
    #endregion
    $out .= '</table></nav>';
    return $out;
}

/**
 * function that will display table's data as a select
 * @param array table's data
 * @param string table's index
 * @return string html select with table's data
 */
function display_select($table, $idx = NULL) {
  if ($table == NULL) {
    return false;
  }
  $table['data'] = $table;
  $table['column'] = current($table);
  $out = '';  // the return value
  $actual_id = 0; // actual index
  $fields_name[] = $table['column'];  // contains the schema's columns
  // cross the different columns to get the future select
  foreach ($fields_name as $col) {
    foreach ($col as $col_key => $col_value) {
      if (strpos(strtolower($col_key), 'id') === false) {
        $out .= sprintf('<select class="custom-select" data-toggle="dropdown" id=\'%s\' name=\'%s\'><div class=\'dropdown-menu\'>', $col_key, $col_key);
        // table data
        foreach ($table['data'] as $record) {
          foreach ($record as $key => $value) {
            if (strpos(strtolower($key), 'id') === false && $key == $col_key) {
              if (stripos($value, $idx) !== false) {
                $out .= sprintf('<option value="%s" selected="selected">%s', $value, $value);
              } else {
                 $out .= sprintf('<option value="%s">%s', $value, $value);
              }
            } 
          }
          $out .= '</option>';
        }
        $out .= '</div></select>';
        return $out;
      }
    }
  }
}

/**
 * function that will transform table's data as an html nav
 * @param array table's data
 * @param string table's index
 * @param bool true if user has the possibility to update data
 * @param bool true if user has the possibility to activate something
 * @param bool true if user has the possibility to delete data
 * @param bool true if user has the possibility to download medias
 * @return string table's data in html nav
 */
function display_nav($table, $idx, $title, $has_update = false, $has_activation = false, $has_delete = false, $has_download = true) {
  if ($table == NULL) {
    return false;
  }
  $table['data'] = $table;
  $table['column'] = current($table);
  $out = '';  // the return value
  $id = 0; // actual index
  $fields_name[] = $table['column'];  // contains the schema's columns

  $out .= '<div>';
  $attachments = array();
  #region data
  foreach ($table['data'] as $record) {
    if (isset($record['media'])) {
      if ($record['media'] != array()) {
        $attachments = $record['media'];
      }
    }
    foreach ($record as $key => $value) {
      // check if index and save it
      if (stripos($key, $idx) !== false) {
        $id = $value;
        $out .= '<div class="card"><div class="card-body">';
        $out .= ($has_delete) ? sprintf('<button type="submit" class="btn btn-outline-secondary" value="delete-%d" name="do">Delete</button>', $id) : ''; 
        $out .= ($has_update) ? sprintf('<button type="submit" class="btn btn-outline-secondary" value="update-%d" name="do">Update</button>', $id) : '';
      } else if (stripos($key, $title) !== false) {
        $out .= sprintf('<h5 class="card-title">%s</h5>', $value);
      }
      //if deleted
      if (stripos($key, IS_DELETED) !== false) {
        if ($value == 1) {
          if ($has_activation) {
            $out .= sprintf('<td><button type="submit" class="btn btn-outline-secondary" value="activate-%d" name="do">Activate</button></td>', $id);
          } else {
            $out = '';
          }
        } else {
          $out .= sprintf(($has_activation) ? '<td><button type="submit" class="btn btn-outline-secondary" value="deactivate-%d" name="do">Deactivate</button></td>' : '', $id);
        }
      }
      // if it's not the id col nor the status (delete or not) col
      else if (stripos(strtolower($key), 'id') === false && stripos(strtolower($key), 'creation') === false  && strpos(strtolower($key), 'media') === false) {
        $out .= sprintf('<p class="card-text" id="%s">%s</p>', $id, $value);
      }
    }
    #region media
    if ($attachments != array()) {
      $out .= '</div><div class="card-footer">';
      foreach ($attachments as $media) {
        $file = $media['Nm_File'];
        $name = $media['Nm_Attachment'];
        $mime = $media['Cd_Mime_Type'];
        $size = $media['Nb_Bytes'];
        $out .='<p class="card-footer card-text"><a class="card-link" href="?action=file&do=read&file='. $file 
        . '&name=' . $name . '&mime=' . $mime . '&size=' . $size . '">
          <img src="assets/img/file.svg" height="20"/>' . $name . '</a>';
        if ($has_download == true) {
            $out .='<a class="card-link" href="?action=file&do=download&file='. $file 
          . '&name=' . $name . '&mime=' . $mime . '&size=' . $size . '">
            <img src="assets/img/download.svg" height="20"/>' . $name . '</a></p>';
        }
      }
    }
    #endregion
    $attachments = array();
    $out .= '</div></div>';
  }
  #endregion
  $out .= '</div>';
  return $out;
}

/**
 * verify if the given string is OK.
 * @param string the given string
 * @param int min size allowed
 * @param int max size allowed
 * @param bool will know if number are permit or not
 * @return bool false if error in string
 */
function check_name($string, $min_size, $max_size, $allow_number = false) {
  if($string){
        if (!(strlen($string) < $min_size && strlen ($string) > $max_size))
            $flag = false;
        if ($allow_number == false){
            //regular expression, get letter only
            $re = '/^[A-Za-z]+$/';
            if(!preg_match($re, $string))
                return false;
        } else {
          //regular expression, get alphanumeric char
          $re = '/^[A-Za-z0-9]+$/';
          if (!preg_match($re, $string)) {
            return false;
          }
        }
    }
    else {
        return false;
    }
    return true;
}

/**
 * @param int salt' length
 * @return string salt
 */
function generate_salt($length=20){
  $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  $rndStr='';
  for ($i=0; $i < $length; $i++) { 
      $idx = rand(0,61);
      $char=$chars[$idx];
      $rndStr.=$char;
  }
  return $rndStr;
}
