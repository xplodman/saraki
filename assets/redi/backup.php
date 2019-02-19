<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include_once "../php/connection.php";

    $filename = $_GET["filename"];
    echo exec('mysqldump -e -uroot -proot -hlocalhost 5inarch > "'.$filename.'.sql ');
