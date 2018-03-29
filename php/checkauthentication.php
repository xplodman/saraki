<?php
session_start();
if (!isset($_SESSION['authenticate']) and $_SESSION['authenticate']!="true")
{
    header('Location: login.php');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
};
if (isset($_SESSION['authenticate']))
{
    if(time() - $_SESSION['timestamp'] > 900) { //subtract new timestamp from the old one
        header('Location: php/logout.php');
    } else {
        $_SESSION['timestamp'] = time(); //set new timestamp
    }
}
?>