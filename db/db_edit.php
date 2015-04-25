<?php

require_once '../config.php';

$link = mysql_connect($db_host, $db_user, $db_pass);
$db_selected = mysql_select_db($db_dbname, $link);
mysql_set_charset('utf8');

$id = $_POST['id'];
$t = htmlspecialchars($_POST['title']);
$a = htmlspecialchars($_POST['author']);
$y = $_POST['year'];
$o = htmlspecialchars($_POST['option']);

$sql = "UPDATE $db_tablename SET `title` = '$t', `author` = '$a', `year` = '$y', `option` = '$o' WHERE id = '$id'";
$result_flag = mysql_query($sql);

mysql_close($link);
header("Location: $index_url");
exit();
