<?php
session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
    setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Yashy農園</title>
</head>
<body>
ログアウトしました。<br />
Logout.<br />
<br />
<a href="../staff_login/staff_login.html">ログイン画面へ</a><br />
<a href="../staff_login/staff_login.html">Login</a>
</body>
</html>
