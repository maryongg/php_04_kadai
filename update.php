<?php
// エラーを出力する
ini_set( 'display_errors', 1 );


//1.　POSTデータ取得
$name        = $_POST['name'];
$age         = $_POST['age'];
$income      = $_POST['income'];
//id分を追加
$id = $_POST["id"];


//2.　データベース接続
include("function.php");// function化
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "UPDATE kadai_table SET name=:name, age=:age, income=:income WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age',       $age,       PDO::PARAM_INT);
$stmt->bindValue(':income',      $income,      PDO::PARAM_STR);
$stmt->bindValue(':id',          $id,          PDO::PARAM_STR);
$status = $stmt->execute();//SQL実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);//function化
} else {
    redirect("read.php");//function化
}
?>