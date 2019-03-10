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

<!-- 登録されているスタッフのデータを修正する画面 -->

<?php

try
{

// 選択されたproduct codeを受け取る
$pro_code=$_GET['procode'];

// DBに接続
$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

// productテーブルから1件のレーコードを取ってくる
$sql = 'SELECT name,price,gazou FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_price=$rec['price'];
$pro_gazou_name_old=$rec['gazou'];

$dbh = null;

if($pro_gazou_name_old=='')
{
      $disp_gazou='';
}
else
{
      $disp_gazou='<img src="./gazou/'.$pro_gazou_name_old.'">';
}

}
catch(Exception $e)
{
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}

?>

<!-- PHPはここまで。ここから下はHTMLで記述する。
ここで修正画面を表示する。フロントの実装。
スタッフコードとスタッフ名はPHPの変数の中に入っているので、
<?php 〜?>でPHPの世界を細かく作って表示する。
-->

商品修正 <br />
Product Staff<br />
<br />
<!-- スタッフコードの表示 -->
商品コード<br />
Product #<br />
<?php print $pro_code;?>
<br />
<br />
<form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
<input type="hidden" name="code" value="<?php print $pro_code;?>">
<input type="hidden" name="gazou_name_old" value="<?php print $pro_gazou_name_old; ?>">

<!-- 商品コードの表示 -->
<!-- あらかじめテキストボックスにデフォルト値として、商品名を入れておく -->
商品名 <br />
Product Name<br />
<input type="text" name="name" style="width:200px" value="<?php print $pro_name;?>"><br />
価格<br />
Price<br />
<input type="text" name="price" style="width:50px" value="<?php print $pro_price;?>">円（¥）<br />
<br />
<?php print $disp_gazou;?>
<br />
画像を選んでください。<br />
<input type="file" name="gazou" style="width:400px"><br />
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">

</form>

</body>
</html>
