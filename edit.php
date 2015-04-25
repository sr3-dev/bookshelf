<?php

require_once 'config.php';
require_once 'layout.php';
$link = mysql_connect($db_host, $db_user, $db_pass);
$db_selected = mysql_select_db($db_dbname, $link);
mysql_set_charset('utf8');

$result = mysql_query("SELECT * from $db_tablename where `id`=".$_GET['id']);
$values = mysql_fetch_assoc($result);
$t = $values['title'];
$a = $values['author'];
$y = ($values['year'] == 0) ? '' : $values['year'];
$o = $values['option'];
mysql_close($link);

?>

<?php echo $head; ?>

<a href="index.php">トップへ戻る</a>
<h4>書籍情報の変更</h4>
<form action="db/db_edit.php" method="post">
  <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
  <label>書名： <input type="text" name="title" size="255" value="<?php echo $t ?>" placeholder="書名（入力必須）" required /></label>
  <label>著者： <input type="text" name="author" size="255" value="<?php echo $a ?>" placeholder="著者"  /></label>
  <label>　年： <input type="text" name="year" size="4" value="<?php echo $y ?>" placeholder="2015" pattern="^[0-9]{3,4}$" /></td></label>
  <label>備考： <input type="text" name="option" size="255" value="<?php echo $o ?>" placeholder="なにかあれば" /></label>
  <button class="btn btn-info">変更する</button>
</form>
<br />
<form action="db/db_delete.php" method="post" onSubmit="return check();">
<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
<button class="btn btn-danger" >削除</button>
</form>

<script>
  function check(){
    if(window.confirm('この書籍をデータベースから削除しますか？')){
      return true; // 「OK」時は送信を実行
    }
    else{ // 「キャンセル」時の処理
      return false; // 送信を中止
    }
  }
</script>

<?php echo $foot; ?>
