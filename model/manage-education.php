<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/27)
 */

 $name = filter_input(INPUT_POST, 'education', FILTER_SANITIZE_STRING);
 $btn = filter_input(INPUT_POST, 'do', FILTER_SANITIZE_STRING);

 if ($name != NULL && $btn == 'create') {
    create_education($name);
 }