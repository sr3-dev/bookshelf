<?php

require_once 'config.php';
require_once 'layout.php';
$link = mysql_connect($db_host, $db_user, $db_pass);
$db_selected = mysql_select_db($db_dbname, $link);
mysql_set_charset('utf8');

?>

<?php echo $head; ?>

<a href="add.php">書籍の追加はこちら</a><br />
<a href="index.php">&#8811;すべて表示</a>&nbsp;
<a href="index.php?status=1">&#8811;貸出中をすべて表示</a>

<div id="search_box">
<form action="db/db_search.php" method="post">
<label class="radio inline">
  <input type="radio" name="search_target" value="title" checked>
  書名
</label>
<label class="radio inline">
  <input type="radio" name="search_target" value="author">
  著者　
</label>
  <input name="query" class="input-xlarge" placeholder="...を含む" />
  <button type="submit" class="btn btn-small">検索</button>
</form>
</div>

<table id="book-list" class="table table-hover table-bordered">
<thead>
  <tr><th>#</th><th width="220">書名</th><th width="120">著者</th><th width="30">年</th><th>状態</th><th width="30" class="no-sort"></th></tr>
</thead>
<tbody>

<?php
// select books to display based on the given GET parameters
$conditions = array();
foreach ($_GET as $key => $value) {
  array_push($conditions, "`$key` like '%$value%'");
}
if (!empty($conditions)) $result = mysql_query("SELECT * from $db_tablename where ".implode(' and ', $conditions));
else $result = mysql_query("SELECT * from $db_tablename");

while ($row = mysql_fetch_assoc($result)) {
  $id = $row['id'];
  $title = $row['title'];
  $author = $row['author'];
  $year = ($row['year'] == 0) ? '' : $row['year'];
  $name = $row['name'];
  $from = $row['from'];

  $status = "<form action='db/db_rental.php' method='post'> <input type='hidden' name='id' value='$id' />";
  if ($row['status'] == 0) {
    $status .= "<button class='btn btn-small btn-primary'>かりる</button> <input name='name' required class='input-mini' placeholder='name' />";
  } else {
    $status .= "<button class='btn btn-small btn-success'>かえす</button> <b>$name</b> ($from)";
  }
  $status .= "</form>";
  echo "<tr><th>$id</th><td>$title</td><td>$author</td><td>$year</td><td>$status</td><td><a href='edit.php?id=$id'>edit</a></td></tr>";
}
mysql_close($link);
?>

</tbody>
</table>

<script src="js/tablesort.min.js"></script>
<script src="js/tablesort.numeric.js"></script>
<script>
  new Tablesort(document.getElementById('book-list'));
</script>

<?php echo $foot; ?>
