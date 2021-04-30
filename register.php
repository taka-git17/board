<?php
$name = $_POST['name'];
$mail = $_POST['mail'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$dsn = "mysql:host=localhost; dbname=board; charset=utf8";
$username = "root";
$password = "root";
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

$sql = "SELECT *FROM users WHERE mail = :mail";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':mail', $mail);
$stmt->execute();
$member = $stmt->fetch();
if ($member['mail'] === $mail) {
    $msg = "同じメールアドレスが存在します。";
    $link = '<a href="registerForm.php">戻る</a>';
} else {
    $sql = "INSERT INTO users(name, mail, pass) VALUES(:name, :mail, :pass)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':mail', $mail);
    $stmt->bindValue(':pass', $pass);
    $stmt->execute();
    $msg = "会員登録が完了しました。";
    $link = '<a href="loginForm.php">ログインページ</a>';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録 - 一言掲示板</title>
</head>
<body>
    <h1><?php echo $msg; ?></h1>
    <?php echo $link; ?>
</body>
</html>