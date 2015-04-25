<?php

require_once 'layout.php';
echo $head;

?>

<a href="index.php">トップへ戻る</a>
<h4>書籍の追加</h4>
<form action="db/db_add.php" method="post">
  <label>書名： <input type="text" name="title" size="255" value="" placeholder="書名（入力必須）" required /></label>
  <label>著者： <input type="text" name="author" size="255" value="" placeholder="著者"  /></label>
  <label>　年： <input type="text" name="year" size="4" value="" placeholder="2015" pattern="^[0-9]{3,4}$" /></td></label>
  <label>備考： <input type="text" name="option" size="255" value="" placeholder="なにかあれば" /></label>
  <button class="btn">追加する</button>
</form>

<?php echo $foot; ?>
