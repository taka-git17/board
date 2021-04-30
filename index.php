<?php
    session_start();
    $dsn = 'mysql:dbname=board; host=localhost';
    $username= 'root';
    $password= 'root';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Location: http://localhost:8888/board/');
        try{
            $dbh = new PDO($dsn, $username, $password);
            $sql = "INSERT INTO boards (name, content) VALUES(:name, :content)";
            $stmt = $dbh->prepare($sql);
            $params = array(':name' => $_REQUEST['name'], ':content' => $_REQUEST['content']);
            $stmt->execute($params);
        } catch(PDOException $e){
            echo "失敗:" . $e->getMessage() . "\n";
            exit();
        }
    }
?>



<?php
if ($_SESSION['mail'] == NULL) {
    $msg = "セッションが切れています";
    echo "<h1>" . $msg . "</h1>";
    echo '<a href="loginForm.php">ログイン画面へ</a>';
} else {
    ?>
    
    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <div>
            <div><a href="logout.php">ログアウト</a></div>
            <form action="index.php" method="post">
                <label for="comment">投稿者</label>
                <input type="text" name="name">
                <br>
                <label for="comment">内容</label>
                <input type="text" id="comment" name="content">
                <input type="submit">
            </form>
        </div>
        
        <?php
            $dbh = new PDO($dsn, $username, $password);
            $sql = "SELECT * FROM boards ORDER BY id DESC";
            $stmt = $dbh->query($sql);
    
            echo "<table>";
                echo "<tr>";
                echo "<th>Id</th><th>お名前</th><th>メッセージ</th>\n";
                echo "</tr>";
                foreach ($stmt as $user) {
                    echo "<tr>";
                    echo "<td>" . $user['id'] . "</td>";
                    echo "<td>" . $user['name'] . "</td>";
                    echo "<td>" . $user['content'] . "</td>";
                    echo "<td>" . "<a href=edit.php?id=" . $user['id'] . ">編集</a>" . "</td>";
                    echo "<td>" . "<a href=delete.php?id=" . $user['id'] . ">削除</a>" . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
        ?>
    </body>
    </html>
   <?php 
}
?>




