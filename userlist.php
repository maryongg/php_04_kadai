<?php
//0. SESSION開始！！
session_start();
// エラーを出力する
ini_set( 'display_errors', 1 );

//2.　データベース接続
include("function.php");// function化
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_user_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ユーザー一覧</title>
</head>
<body>
<?php include("menu.php"); ?>
<div class="zentai">
<p>ユーザー一覧</p>
<table>
    <tr>
        <th>名前</th>
        <th>管理フラグ</th>
        <th>削除</th>
        <th>編集</th>

    </tr>
    <?php foreach($values as $v){ ?>
        <tr>
        <td><?=$v["name"]?></td>
        <td><?=$v["kanri_flg"]?></td>
        <td><a href="delete_user.php?id=<?=$v["id"]?>">削除</a></td>
        <td><a href="edit_user.php?id=<?=$v["id"]?>">編集</a></td>
        </tr>

    <?php } ?>
</table>

</div>
</body>
</html>