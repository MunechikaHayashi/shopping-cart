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

// 選択されたスタッフ「コード」を受け取る
$staff_code=$_GET['staffcode'];

// DBに接続
$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

// スタッフ「コード」でstaffテーブルから1件のレーコードを取ってくる
$sql = 'SELECT name FROM mst_staff WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[]=$staff_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$staff_name=$rec['name'];

$dbh = null;

}
catch(Exception $e)
{
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}

?>

<!-- PHPはここまで。ここから下はHTMLで記述する。
ここでスタッフ情報画面を表示する。フロントの実装。
スタッフコードとスタッフ名はPHPの変数の中に入っているので、
<?php 〜?>でPHPの世界を細かく作って表示する。
-->

スタッフ情報参照<br />
Staff Info<br />
<br />
<!-- スタッフコードの表示 -->
スタッフコード<br />
Staff #<br />
<?php print $staff_code;?>
<br />
スタッフ名<br />
Staff Name<br />
<?php print $staff_name;?>
<br />
<br />
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>

</body>
</html>
