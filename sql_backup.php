<?php include_once('Mysqldump/Mysqldump.php');
$dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=buspassms', 'root', '');
$f=date('d-m-Y');
$dump->start("database_backup/buspassms.sql");
$dump->start("D:/UTU/PHP/buspassms.sql");

echo "done";

?>