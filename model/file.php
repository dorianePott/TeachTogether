<?php
#region init
$do   = filter_input(INPUT_GET, 'do', FILTER_SANITIZE_STRING);
$file = filter_input(INPUT_GET, 'file', FILTER_SANITIZE_STRING);
$mime = filter_input(INPUT_GET, 'mime', FILTER_SANITIZE_STRING);
$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
$size = filter_input(INPUT_GET, 'size', FILTER_SANITIZE_NUMBER_INT);

$path = 'storage/';
#endregion

if ($do == 'download') {
    //make sure the fil exists before doing anything!!
    if (file_exists($path.$file)) {
        header('Pragma: public');   //required
        header('Expires: 0');   // no expiration date
        // no cache
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false);

        header('Content-Type: '. $mime);
        header('Content-Disposition: attachment; filename="'.$name.'"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '.$size);   // provide file size
        header('Connection: close');
        readfile($path.$file);  //push it pit
    }
    echo '<script>window.close();</script>';
    exit();
} else if ($do == 'read') {
    $reading = fopen($path.$file, 'r') or die('Unable to open file');
    // code below from alexandre benzonana
    header('Cache-Control: public');
    header('Content-Type: ' . $mime);
    header('Content-Disposition: inline; filename="' . $name . '"');
    header('Content-Length: ' . $size);
    // end of bezonana's code
    echo fread($reading, $size);
    fclose($reading);
}