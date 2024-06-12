<?php
// エラーを出力する
ini_set( 'display_errors', 1 );

//1.　POSTデータ取得
$name        = $_POST['name'];
$age         = $_POST['age'];
$income      = $_POST['income'];
$date        = date('Y-m-d H:i:s');

//2.　データベース接続
include("function.php");// function化
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO kadai_table(name,age,income,indate)VALUES(:name,:age,:income,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name'     ,$name,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age'      ,$age,   PDO::PARAM_INT);
$stmt->bindValue(':income'   ,$income,PDO::PARAM_STR);
$status = $stmt->execute();//SQL実行

//４．データ登録処理後
if($status==false){
    sql_error($stmt);//function化
} else {
    // redirect("index.php");//function化
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>入力画面</title>
</head>
<body>
<div class="zentai">
<p>登録完了しました！</p>
お名前：<p><?php echo $name?></p><br>
年齢：<p><?php echo $age?></p><br>
年収：<p><?php echo $income?></p>
<br>
</div>
</body>
</html>