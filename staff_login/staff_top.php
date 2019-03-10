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

ショップ管理トップメニュー<br />
Shop TOP Menu<br />
<br />
<a href="../staff/staff_list.php">スタッフ管理</a><br />
<a href="../staff/staff_list.php">Staff Manager</a><br />
<br />
<a href="../product/pro_list.php">商品管理</a><br />
<a href="../product/pro_list.php">Product Manager</a><br />
<br />
<a href="../order/order_download.php">注文ダウンロード</a><br />
<a href="../order/order_download.php">Order Download</a><br />
<br />
<a href="staff_logout.php">ログアウト</a><br />
<a href="staff_logout.php">Logout</a><br />

</body>
</html>
