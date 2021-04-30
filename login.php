<?php
session_start();
$mail = $_POST['mail'];
$dsn = "mysql:host=localhost; dbname=board; charset=utf8";
$username = "root";
$password = "root";
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

$sql = "SELECT * FROM users WHERE mail = :mail";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':mail', $mail); 
$stmt->execute();
$member = $stmt->fetch();
if (password_verify($_POST['pass'], $member['pass'])) {
    $_SESSION['mail'] = $member['mail'];
    header('Location: http://localhost:8888/board/');
} else {
    $msg = 'メールアドレスもしくはパスワードが間違っています。';
    $link = '<a href="loginForm.php">戻る</a>';
}
echo "<h1>" . $msg . "</h1>";
echo $link;
?>

