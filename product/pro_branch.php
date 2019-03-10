<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
    print'ログインされていません。<br />';
    print'<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
}

// 参照
if(isset($_POST['disp'])==true)
{
  //スタッフコードに何も入っていない場合、NG画面に飛ばす
  if(isset($_POST['procode'])==false)
  {
    header('Location: pro_ng.php');
    exit();
  }

  $pro_code=$_POST['procode'];
  header('Location: pro_disp.php?procode='.$pro_code);
  exit();
}
// 追加
if(isset($_POST['add'])==true)
{
    header('Location: pro_add.php');
    exit();
}
// 編集
if(isset($_POST['edit'])==true)
{
  //スタッフコードに何も入っていない場合、NG画面に飛ばす
    if(isset($_POST['procode'])==false)
    {
          header('Location: pro_ng.php');
          exit();
    }

    $pro_code=$_POST['procode'];
    header('Location: pro_edit.php?procode='.$pro_code);
    exit();
}
// 削除
if(isset($_POST['delete'])==true)
{
  //スタッフコードに何も入っていない場合、NG画面に飛ばす
    if(isset($_POST['procode'])==false)
    {
      header('Location: pro_ng.php');
      exit();
    }

    $pro_code=$_POST['procode'];
    header('Location: pro_delete.php?procode='.$pro_code);
    exit();
}

 ?>
