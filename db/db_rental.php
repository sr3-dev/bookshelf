<?php

require_once '../config.php';

$link = mysql_connect($db_host, $db_user, $db_pass);
$db_selected = mysql_select_db($db_dbname, $link);
mysql_set_charset('utf8');

$id = $_POST['id'];
$name = $_POST['name'];

$result = mysql_query("SELECT * from $db_tablename where `id`=$id");
$values = mysql_fetch_assoc($result);
$changed_status = ($values['status'] == 0) ? 1 : 0;

$d =  date("Y-m-d H:i:s", time());

$sql = "UPDATE $db_tablename SET `status` = '$changed_status', `name` = '$name', `from` = '$d' WHERE `id` = '$id'";
$result_flag = mysql_query($sql);

mysql_close($link);
header("Location: $index_url");
exit();
