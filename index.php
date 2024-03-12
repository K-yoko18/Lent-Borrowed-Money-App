<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サインインページ</title>
    <link rel="stylesheet" href="css/Main.css">
</head>
<body>
    <?php
        if(isset($_POST["mail"]))
        {
            session_start();
            $dbh = new PDO("mysql:dbname=wat2023;host=localhost;charset=utf8mb4", "wat2023", "1315KJ201");
            $mail = $_POST['mail'];
            $sql = "SELECT * FROM g08_user WHERE mail = :mail";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':mail', $mail);
            $stmt->execute();
            $member = $stmt->fetch();
        
            // 入力されたパスワードを同じ暗号化メソッドでハッシュ化
            $input_password = encryptPass($_POST['mail'], $_POST['pass']);
        
            // ハッシュが一致するか確認
            if ($input_password == $member['pass']) {
                // ログイン成功
                $_SESSION['id'] = $member['id'];
                $_SESSION['name'] = $member['name'];
                header( "Location: borrowing.php" ) ;
                exit();
            } else if (empty($member)) {
                // ログイン失敗
                $alert_msg = "メールアドレスが登録されていません。";
                $alert = "<script type='text/javascript'>alert('". $alert_msg. "');</script>";
                echo $alert;
                $link = '<a href="index.php">戻る</a>';
            }
            else {
                // ログイン失敗
                $alert_msg = "パスワードが間違っています。";
                $alert = "<script type='text/javascript'>alert('". $alert_msg. "');</script>";
                echo $alert;
                $link = '<a href="index.php">戻る</a>';
            }
        }

        // パスワードの暗号化
        function encryptPass($user_mail, $user_pass){
            // まず名前とパスを連結
            $encryptedPass = $user_mail.$user_pass;
            // 1986回のストレッチング
            for($i = 0; $i < 1986; $i++){
                // 暗号化
                $encryptedPass = md5($encryptedPass);
                // 100回に一度ソルトを追加
                if($i % 100 == 0) $encryptedPass = md5($encryptedPass."TokyoUniversityOfTechnology");
            }
            // 結果を返す
            return $encryptedPass;
        }
    ?>

    <header>
        <h1>個人債務管理</h1>
    </header>

    <nav>
        <!-- ナビゲーションメニュー -->
    </nav>

    <main>
        <!-- サインインフォームのコンテンツをここに挿入します -->
        <div class="form-wrapper">
            <h1>Sign In</h1>
            <form action="" method="POST">
                <div class="form-item">
                    <label for="email"></label>
                    <input type="email" name="mail" required="required" placeholder="Email Address">
                </div>
                <div class="form-item">
                    <label for="password"></label>
                    <input type="password" name="pass" required="required" placeholder="Password" id="password">
                </div>
                <div class="button-panel">
                    <input type="submit" class="button" title="Sign In" value="Sign In">
                </div>
            </form>
            <div class="form-footer">
                <p><a href="CreateAccount.php">Create an account</a></p>
            </div>
        </div>
    </main>

    <aside>
        <!-- サイドバーに関する情報 -->
    </aside>

    <footer>
        <!-- フッター情報、著作権など -->
        <p>&copy; G08</p>
    </footer>

    <script>
        document.getElementById('sign-in-form').onsubmit = function(event) {
            event.preventDefault(); // デフォルトのフォーム送信を阻止
            // ここにサインインの検証処理を追加する場合は、そのコードを書く
            // 検証に成功したら、borrowing.htmlにリダイレクトする
            // window.location.href = 'borrowing.html';
        };
    </script>

</body>
</html>
