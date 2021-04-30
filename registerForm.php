<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録 - </title>
</head>
<body>
    <h1>新規会員登録</h1>
    <p>* は必須項目です</p>
    <form action="register.php" method="post">
    <div>
        <label>*名前：<label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>*メールアドレス：<label>
        <input type="text" name="mail" required>
    </div>
    <div>
        <label>*パスワード：<label>
        <input type="password" name="pass" required>
    </div>
    <input type="submit" value="新規登録">
    </form>
</body>
</html>