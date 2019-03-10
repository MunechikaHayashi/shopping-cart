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

商品追加<br />
Add product<br />
<br />
<form method="post" action="pro_add_check.php" enctype="multipart/form-data">
商品名を入力してください。<br />
Please enter a product name. <br />
<input type="text" name="name" style="width:200px"><br />
価格を入力してください。<br />
Please enter a price. <br />
<input type="text" name="price" style="width:50px"><br />
画像を選んでください。<br />
Chose the picture.<br />
<input type="file" name="gazou" style="width:400px"><br />
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>
