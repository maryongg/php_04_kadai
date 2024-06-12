<?php
// エラーを出力する
ini_set( 'display_errors', 1 );


//1.　POSTデータ取得
$name        = $_POST['name'];
$kanri_flg         = $_POST['kanri_flg'];
$id      = $_POST['id'];

//2.　データベース接続
include("function.php");// function化
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "UPDATE gs_user_table SET name=:name, kanri_flg=:kanri_flg WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg',       $kanri_flg,       PDO::PARAM_INT);
$stmt->bindValue(':id',          $id,          PDO::PARAM_INT);
$status = $stmt->execute();//SQL実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);//function化
} else {
    redirect("userlist.php");//function化
}
?>