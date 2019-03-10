<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
  print'ようこそゲスト様<br />';
  print'<a href="member_login.html">会員ログイン(Hello, Sign in)</a><br />';
  print'<br />';
}
else
{
  print'ようこそ';
  print $_SESSION['member_name'];
  print '様';
  print '<a href="member_logout.php">ログアウト(Sign out)</a><br />';
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

<?php

try
{

if(isset($_SESSION['cart'])==true)
{
  $cart= $_SESSION['cart'];
  $kazu= $_SESSION['kazu'];
  $max=count($cart);
}
else
{
  $max=0;
}

if($max==0)
{
  print'カートに商品がありません。<br />';
  print'<br />';
  print'<a href="shop_list.php">商品一覧へ戻る</a>';
  exit();
}

// DBに接続
$dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

foreach($cart as $key => $val)
{
    $sql = 'SELECT code,name,price,gazou FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[0]=$val;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    $pro_name[]=$rec['name'];
    $pro_price[]=$rec['price'];
    if($rec['gazou']=='')
    {
      $pro_gazou[]='';
    }
    else
    {
      $pro_gazou[]='<img src="../product/gazou/'.$rec['gazou'].'">';
    }
}
$dbh = null;


}catch(Exception $e){
  print'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}

?>

カートの中身(Cart)<br />
<br />
<form method="post" action="kazu_change.php">
<table border="1">
<tr>
<td>商品(Product)</td>
<td>商品画像(image)</td>
<td>価格(price)</td>
<td>数量(Qty)</td>
<td>小計(Subtotal)</td>
<td>削除(Delete)</td>
</tr>
<?php for($i=0;$i<$max;$i++)
  {
?>
<tr>
  <td><?php print $pro_name[$i]; ?></td>
  <td><?php print $pro_gazou[$i]; ?></td>
  <td>¥<?php print $pro_price[$i]; ?></td>
  <td><input type="text" name="kazu<?php print $i;?>" value="<?php print $kazu[$i];?>"></td>
  <td>¥<?php print $pro_price[$i]*$kazu[$i];?></td>
  <td><input type="checkbox" name="sakujo<?php print $i; ?>"></td>
</td>
<?php
  }
?>
</table>
<input type="hidden" name="max" value="<?php print $max;?>">
<input type="submit" value="数量変更(Change of Amount)"><br />
<input type="button" onclick="history.back()" value="Back">

</form>
<br />
<a href='shop_form.html'>ご購入手続きへ進む(Proceed to chckout)</a><br />

<?php
    if(isset($_SESSION["member_login"])==true)
    {
        print'<a href="shop_kantan_check.php">会員かんたん注文ヘ進む</a><br />';
    }
?>

</body>
</html>
