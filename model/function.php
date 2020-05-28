<?php

function display_table($table, $has_update = false, $has_activation = false, $has_delete = false){
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
        $out .= '<th scope="col">'.$key.'</th>';
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
        if (strpos(strtolower($key), 'id') !== false) {
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

function display_select($table) {
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
              $out .= sprintf('<option class=\'dropdown-item\' value="%s">%s', $value, $value);
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

function display_nav($table) {
  
}