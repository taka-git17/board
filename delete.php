<?php
try{

    //DBに接続
    $dsn = 'mysql:dbname=board; host=localhost';
    $username= 'root';
    $password= 'root';

    $dbh = new PDO($dsn, $username, $password);
    $stmt = $dbh->prepare('DELETE FROM boards WHERE id = :id'); // 「:id」変数を使ったSQL文

    $stmt->execute(array(':id' => $_GET["id"])); // idを取得して変数に代入
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // SQLの結果を$resultに代入、配列
    echo "<br>";
    
} catch(PDOException $e){
    echo "失敗:" . $e->getMessage() . "\n";
    exit();
}
?>

<html>
<head>
    <meta charset="utf-8">
    <title>削除</title>

    <h2>削除</h2>
        <p>削除しました</p>
        <a href="index.php">投稿一覧へ</a>
</body>
</html>
