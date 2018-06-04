<?php
$host = 'localhost';
$username='permpany_smartm';
$password='gly33140';
$db='permpany_smartm';
mysql_connect($host,$username,$password) or die ('error connect');
mysql_query('set name utf8');
mysql_select_db($db) or die('select error');
?>
