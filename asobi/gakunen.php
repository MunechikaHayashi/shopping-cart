<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Yashy農園</title>
</head>
<body>

<?php
$gakunen=$_POST['gakunen'];

switch($gakunen)
{
    case'1';
            $kousya='あなたの校舎は南校舎です。';
            $bukatsu='自分が本当にやりたいことは何だろうか';
            $mokuhyou='いろいろなことをやってみて自分に合ったものを見つけよう';
            break;
    case'2';
            $kousya='あなたの校舎は西校舎です。';
            $bukatsu='学園祭を目指して全力で取り組みましょう';
            $mokuhyou='今しかできないことを見つけよう';
            break;
    case'3';
            $kousya='あなたの校舎は東校舎です。';
            $bukatsu='最大のパフォーマンスを出すために何が必要か考えよう';
            $mokuhyou='賢者は歴史から学ぶ、愚か者は体験から学ぶ';
            break;
    default;
            $kousya='あなたの校舎は三年生と同じです。';
            $bukatsu='部活動はありません';
            $mokuhyou='早く卒業しましょう';
            break;
}
print '校舎　'.$kousya.'<br />';
print '部活　'.$bukatsu.'<br />';
print '目標　'.$mokuhyou.'<br />';

?>
</body>
</html>
