<?php
try{

    //DBに接続
    $dsn = 'mysql:dbname=board; host=localhost';
    $username= 'root';
    $password= 'root';

    $dbh = new PDO($dsn, $username, $password);
    $stmt = $dbh->prepare('SELECT * FROM boards WHERE id = :id'); // 「:id」変数を使ったSQL文

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
    <title>編集</title>

    <h2>編集</h2>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php if(!empty($result['id']))  echo(htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8')); ?>"> <!-- これを消すと修正されなくなる謎 -->
        <p>
            <label>ID</label>        
            <label type="text" name="id" value="<?php if(!empty($result['id'])) ?>" ><?php echo $result['id'] ?></label>        
        </p>
        <p>
            <label>お名前</label>
            <input type="text" name="update_name" value="<?php if(!empty($result['name']))  echo(htmlspecialchars($result['name'], ENT_QUOTES)); ?>"> <!-- htmlspecialcharsは普通のおm字列にする。 -->
        </p>
        <p>
            <label>発言</label>
            <input type="text" name="update_content" value="<?php if(!empty($result['content']))  echo(htmlspecialchars($result['content'], ENT_QUOTES)); ?>">
        </p>

        <input type="submit" value="編集する">

    </form>
        <a href="index.php">投稿一覧へ</a>
</body>
</html>
