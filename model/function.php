<?php


define('DEFAULT_DIR', 'storage/');
define('MAX_FILE_SIZE', 4194304);  //4MB
define('MAX_RESOURCE_SIZE', 73400320); //70MB
define('ACCENT', 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ');
define('CORRECT_ACCENT', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

function check_size($files) {
    $total = 0;
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
}

function generate_name($name) {
   return md5($name . uniqid() . date('Y-m-d H:i:s')).".".explode('.', $name)[1];
}


/**
 * 
 */
function display_table($table, $idx, $has_update = false, $has_activation = false, $has_delete = false){
    if ($table == NULL) {
      return false;
    }
    $table['data'] = $table;
    $table['column'] = current($table);
    $out = '';  // the return value
    $nb_col = 0;  // the number of max column
    $count = 0; // count the actual column
    $id = 0; // actual index
    $fields_name[] = $table['column'];  // contains the schema's columns

    #region header
    $out .= '<table class="table">';
    $out .= '<thead class="thead-light"><tr>';
    // cross the different column to get there name to display them later
    foreach ($fields_name as $col) {
      foreach ($col as $key => $value) {
        $out .= '<th>'.$key.'</th>';
        $nb_col++;
      }
    }
    $out .= (($has_delete) ? '<th>Deletion</th>' : '') . (($has_update) ? '<th>Update</th>' : '') . (($has_activation) ? '<th>Activate</th></tr></thead>' : '');
    $out .= '</tr></thead>';
    #endregion
    #region data
    foreach ($table['data'] as $record) {
      foreach ($record as $key => $value) {
        // check if index and add index at the <td>
        if (stripos($key, $idx) !== false) {
          $id = $value;
        }
        $out .= sprintf('<td id="%s">%s</td>', $id, $value);
        // at the final column, will display option of deletion and update
        if ($count == $nb_col - 1) {
            $out .= sprintf(($has_delete) ? '<td><button type="submit" class="btn btn-outline-secondary" value="delete-%d" name="do">Delete</button></td>' : '', $id) 
            . sprintf(($has_update) ? '<td><button type="submit" class="btn btn-outline-secondary" value="update-%d" name="do">Update</button></td>' : '', $id)
            . sprintf(($has_activation) ? '<td><button type="submit" class="btn btn-outline-secondary" value="activate-%d" name="do">Activate</button></td>' : '', $id);
            $count = 0;
        } else {
          $count++;
        }
      }
      $out .= '</tr>';
    }
    #endregion
    $out .= '</table>';
    return $out;
}

/**
 * 
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
        $out .= sprintf('<select class=\'btn dropdown-toggle btn-outline-info\' data-toggle="dropdown" id=\'%s\' name=\'%s\'><div class=\'dropdown-menu\'>', $col_key, $col_key);
        // table data
        foreach ($table['data'] as $record) {
          foreach ($record as $key => $value) {
            if (strpos(strtolower($key), 'id') === false && $key == $col_key) {
              if (stripos($value, $idx) !== false) {
                $out .= sprintf('<option class=\'dropdown-item\' value="%s" selected="selected">%s', $value, $value);
              } else {
                 $out .= sprintf('<option class=\'dropdown-item\' value="%s">%s', $value, $value);
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
 * 
 */
function display_nav($table, $idx, $has_update = false, $has_activation = false, $has_delete = false) {
  if ($table == NULL) {
    return false;
  }
  $table['data'] = $table;
  $table['column'] = current($table);
  $out = '';  // the return value
  $nb_col = 0;  // the number of max column
  $count = 0; // count the actual column
  $id = 0; // actual index
  $fields_name[] = $table['column'];  // contains the schema's columns

  $out .= '<div class="card">';
  $attachments = array();

  $nb_col = count($fields_name[0]);
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
        $out .= '<div class="card-body">';
      } else if (stripos($key, 'Nm_Resource') !== false) {
        $out .= sprintf('<h5 class="card-title">%s</p>', $value);
      }
      // if it's not the id col
      else if (stripos(strtolower($key), 'id') === false && stripos(strtolower($key), 'creation') === false  && strpos(strtolower($key), 'media') === false) {
        $out .= sprintf('<p class="card-text" id="%s">%s</p>', $id, $value);
      }
      // at the final column, will display option of deletion and update
      if ($count == $nb_col - 1) {
          $out .= ($has_delete) ? sprintf('<button type="submit" class="btn btn-outline-secondary" value="delete-%d" name="do">Delete</button>', $id) : ''; 
          $out .= ($has_update) ? sprintf('<button type="submit" class="btn btn-outline-secondary" value="update-%d" name="do">Update</button>', $id) : '';
          $out .= ($has_activation) ? sprintf('<button type="submit" class="btn btn-outline-secondary" value="activate-%d" name="do">Activate</button>', $id) : '';
          $count = 0;
      } else {
        $count++;
      }
    }
    if ($attachments != array()) {
      foreach ($attachments as $media) {
        $file = $media['Nm_File'];
        $name = $media['Nm_Attachment'];
        $mime = $media['Cd_Mime_Type'];
        $size = $media['Nb_Bytes'];

        $out .='<p><a class="card-link" href="?action=file&do=read&file='. $file 
        . '&name=' . $name . '&mime=' . $mime . '&size=' . $size . '">
          <img src="assets/img/file.svg" height="20"/>' . $name . '</a>';
        
          $out .='<a class="card-link" href="?action=file&do=download&file='. $file 
        . '&name=' . $name . '&mime=' . $mime . '&size=' . $size . '">
          <img src="assets/img/download.svg" height="20"/>' . $name . '</a></p>';
      }
    }
    $attachments = array();
    $out .= '</div>';
  }
  #endregion
  $out .= '</div>';
  return $out;
}
