<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録 - フォーム</title>
</head>
<body>
    <h1>新規会員登録</h1>
    <?php
    // エラー文配列
    $nameValid = "名前は5文字以上の入力が必要です。<br />";
    $mailValid = "正しいEメールアドレスを指定してください。<br />";
    $passValid = "パスワードは８文字以上で入力して下さい。<br />";

    if (!empty($_POST)) {
        if (mb_strlen($_POST["name"]) < 5) {
            echo $nameValid;
            $errors = $nameValid;
        }
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            echo $mailValid;
            $errors = $mailValid;
        }
        if (mb_strlen($_POST["pass"]) < 8) {
            echo $passValid;
            $errors = $passValid;
        }  
    }

    ?>
    <p>* は必須項目です</p>
    <?php
    if (empty($errors) && !empty($_POST)) {
    ?>
        <form action="register.php" method="post">
    <?php
    } else {
    ?>
        <form action="#" method="post">
    <?php
    }
    ?>
    <div>
        <?php
        if (mb_strlen($_POST["name"]) < 5) {
            echo $nameValid;
        }
        ?>
        <label>*名前：<label>
        <input type="text" name="name" required>
    </div>
    <div>
        <?php
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            echo $mailValid;
        }
        ?>
        <label>*メールアドレス：<label>
        <input type="text" name="mail" required>
    </div>
    <div>
        <?php
        if (mb_strlen($_POST["pass"]) < 8) {
            echo $passValid;
        }
        ?>
        <label>*パスワード：<label>
        <input type="password" name="pass" required>
    </div>
    <input type="submit" value="新規登録">
    </form>
</body>
</html>