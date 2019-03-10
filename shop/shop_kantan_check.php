<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
    print'ログインされていません。<br />';
    print'<a href="shop_list.php">商品一覧へ</a>';
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Yashy農園</title>
</head>
<body>
<?php

$code=$_SESSION['member_code'];

$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name,email,postal1,postal2,address,tel FROM dat_member WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[]=$code;
$stmt->execute($data);
$rec =$stmt->fetch(PDO::FETCH_ASSOC);

$dbh = null;

$onamae=$rec['name'];
$email=$rec['email'];
$postal1=$rec['postal1'];
$postal2=$rec['postal2'];
$address=$rec['address'];
$tel=$rec['tel'];

print'お名前<br />';
print $onamae;
print '<br /><br />';

print'メールアドレス<br />';
print $email;
print '<br /><br />';

print'郵便局<br />';
print $postal1;
print '-';
print $postal2;
print '<br /><br />';

print'住所<br />';
print $address;
print '<br /><br />';

print'電話番号<br />';
print $tel;
print '<br /><br />';

    print '<form method="post" action="shop_kantan_done.php">';
    print '<input type="hidden" name="onamae" value="'.$onamae.'">';
    print '<input type="hidden" name="email" value="'.$email.'">';
    print '<input type="hidden" name="postal1" value="'.$postal1.'">';
    print '<input type="hidden" name="postal2" value="'.$postal2.'">';
    print '<input type="hidden" name="address" value="'.$address.'">';
    print '<input type="hidden" name="tel" value="'.$tel.'">';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="OK">';
    print '</form>';

?>
</body>
</html>
