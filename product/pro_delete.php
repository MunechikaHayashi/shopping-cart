<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
    print'ログインされていません。<br />';
    print'<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
}
else
{
    print $_SESSION['staff_name'];
    print 'さんログイン中<br />';
    print '<br />';
}
 ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Yashy農園</title>
</head>
<body>

<!-- 登録されている商品を削除する画面 -->

<?php

try
{

// 選択された商品「コード」を受け取る
$pro_code=$_GET['procode'];

// DBに接続
$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

// スタッフ「コード」でstaffテーブルから1件のレーコードを取ってくる
$sql = 'SELECT name,gazou FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_gazou_name=$rec['gazou'];

$dbh = null;

if($pro_gazou_name=='')
{
    $disp_gazou='';
}
else {
  $disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
}

}
catch(Exception $e)
{
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}

?>

<!-- PHPはここまで。ここから下はHTMLで記述する。
ここで削除画面を表示する。フロントの実装。
商品コードと商品名はPHPの変数の中に入っているので、
<?php 〜?>でPHPの世界を細かく作って表示する。
-->

商品削除 <br />
Delete Product<br />
<br />
<!-- スタッフコードの表示 -->
商品コード<br />
Product #<br />
<?php print $pro_code;?>
<br />
商品名<br />
Product Name<br />
<?php print $pro_name;?>
<br />
<br />
<?php print $disp_gazou;?>
<br />
この商品を削除してよろしいですか？<br />
Are you sure you want to delete this product?<br />
<br />
<form method="post" action="pro_delete_done.php">
<input type="hidden" name="code" value="<?php print $pro_code;?>">
<input type="hidden" name="gazou_name" value="<?php print $pro_gazou_name;?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>
