<?PHP 
// エラーを出力する
ini_set( 'display_errors', 1 );

$id = $_GET["id"];

//1.　データベース接続
include("function.php");// function化
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM kadai_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$row = $stmt -> fetch();
// $values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);

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
<p>出会ったお相手を登録！</p>

<form method="POST" action="update.php" enctype="multipart/form-data">
お名前：<input type="text" name="name" value="<?= h($row["name"]) ?>"><br>
年齢：<input type="text" name="age" value="<?= h($row["age"]) ?>"><br>
年収：<select name="income">
    <option value="<?= h($row["income"]) ?>"><?= h($row["income"]) ?></option>
    <option value="200">200万円未満</option>
    <option value="200-400">200万円~400万円</option>
    <option value="400-600">400万円~600万円</option>
    <option value="600-800">600万円~800万円</option>
    <option value="800-1000">800万円~1000万円</option>
    <option value="1000-1500">1000万円~1500万円</option>
    <option value="1500-2000">1500万円~2000万円</option>
    <option value="2000">2000万円以上</option>
</select>
<br>
<input type="hidden" name="id" value="<?= $row["id"] ?>">
<input type="submit" value="更新">
</form>

<a href="read.php">登録メンズ一覧！</a>

    <!-- form - start -->
    <form action="delete.php" method="post">
      <div class="mt-4">
        <input type="hidden" name="id" value="<?= $row["id"] ?>">
        <button id="delete">削除</button>
      </div>
    </form>
    <!-- form - end -->


</div>
</body>
</html>