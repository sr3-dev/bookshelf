<?php

require_once '../config.php';

$target = $_POST['search_target'];
$query = htmlspecialchars($_POST['query']);

$url = "$index_url?$target=$query";
header("Location: $url");
exit();

