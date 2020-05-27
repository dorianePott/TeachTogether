<?php
/**
 * @author Doriane Pott
 * @version 1.0 (2020/05/26)
 * model page
 */
 session_start();
 $_SESSION['logged'] = FALSE;
 $_SESSION['email'] = '';
 $_SESSION = [];
 session_destroy();
 header('Location: ../index.php?action=home');
 exit();