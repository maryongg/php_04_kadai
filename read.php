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
$sql = "SELECT * FROM kadai_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

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
<?php include("menu.php"); ?>
<div class="zentai">
<p>登録メンズ一覧</p>
<table>
    <tr>
        <th>登録日時</th>
        <th>名前</th>
        <th>年齢</th>
        <th>年収</th>

    </tr>
    <?php foreach($values as $v){ ?>
        <tr>
        <td><a href="detail.php?id=<?=$v["id"]?>"><?=$v["indate"]?></a></td>

        
        <td><?=$v["name"]?></td>
        <td><?=$v["age"]?></td>
        <td><?=$v["income"]?></td>
        
    
        </tr>
    <?php } ?>
</table>




</div>
</body>
</html>