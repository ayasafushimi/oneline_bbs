<?php



try {
  $dbh = new PDO('mysql:host=localhost;dbname=oneline_bbs;', 'ayasa', 'test12345');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die('データベースに接続できません。' . $e->getMessage());
}

//POSTなら保存処理実行
// if($_SERVER['REQUEST_METHOD']==='POST')

$name = $_POST['name'];
$comment = $_POST['comment'];

// 保存
$stmt = $dbh->prepare("INSERT INTO post (name, comment, created_at)VALUES(:name, :comment, :created_at)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':comment', $comment);
$stmt->bindValue(':created_at', date("Y-m-d H:i:s"));
$stmt->execute();

$stmt = $dbh->prepare('SELECT * FROM post');
$stmt->execute();
while ($row = $stmt->fetch()) {
  printf(' name:' . $row['name']);
  printf(' comment:' . $row['comment']);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>ひとことの掲示板</title>
</head>

<body>
  <h1>ひとこと掲示板</h1>

  <form action="bbs.php" method="post">
    名前：　<input type="text" name="name"><br>
    ひとこと：　<input type="text" name="comment"><br>
    <input type="submit" name="submit" value="送信">
  </form>
</body>

<?php






?>

</html>