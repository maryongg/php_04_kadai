<?php
//0. SESSION開始！！
session_start();
// エラーを出力する
ini_set('display_errors', 1);

//2.　データベース接続
include("function.php"); // function化
sschk();
$pdo = db_conn();

$id = $_GET["id"]; //?id~**を受け取る


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <?php include("menu.php"); ?>
    <!-- Head[End] -->


    <!-- Main[Start] -->
    <form method="POST" action="update_user.php">
        <div class="jumbotron">
            <fieldset>
                <legend>[編集]</legend>
                <label>名前：<input type="text" name="name" value="<?= $row["name"] ?>"></label><br>
                <label>管理フラグ：<input type="text" name="kanri_flg" value="<?= $row["kanri_flg"] ?>"></label><br>

                <input type="submit" value="送信">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>