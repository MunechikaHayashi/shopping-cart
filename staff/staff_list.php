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

<br />
<a href="../staff_login/staff_top.php">トップメニューへ</a><br />

<body>

<?php

try {

$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


$sql = 'SELECT code,name FROM mst_staff WHERE 1';
$stmt = $dbh->prepare($sql);
$stmt ->execute();

$dbh = null;

print'スタッフ一覧<br />';
print'Staff List<br /><br />';

print'<form method="post" action="staff_branch.php">';
while(true)
{
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec==false)
    {
      break;
    }
    print'<input type="radio" name="staffcode" value="'.$rec['code'].'">';
    print $rec['name'];
    print'<br />';
}

print'<input type="submit" name="disp" value="参照 Reference">';
print'<input type="submit" name="add" value="追加 Add">';
print'<input type="submit" name="edit" value="修正 Edit">';
print'<input type="submit" name="delete" value="削除 Delete">';
print'</form>';


}
 catch (Exception $e)
{
    print'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}

?>

</body>
</html>
