<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Account</title>
        <link rel="stylesheet" href="css/CreateAccount.css">
    </head>
    <body>
        <?php
            // 名前情報が送信されていれば
            if(isset($_POST["name"]))
            {
                // セッション開始
                session_start();
                // db.phpを読み込み
                include_once('dbUser.php');
                // addUserを実行し結果をセッション変数に保存
                $_SESSION["id"] = addUser($_POST["name"], $_POST["mail"], $_POST["pass"]);
                // upload.phpに移動
                header( "Location: index.php" ) ;
                exit();
            }
        ?>

        <header>
            <h1>アカウント作成</h1>
        </header>

        <nav>
            <!-- ナビゲーションメニュー -->
        </nav>

        <main>
            <div class="form-wrapper">
                <h1>Create Account</h1>
                <form onsubmit="return checkPasswords()" action="" method="POST">
                    <div class="form-item">
                        <label for="username"></label>
                        <input type="text" name="name" required="required" placeholder="Username">
                    </div>
                    <div class="form-item">
                        <label for="email"></label>
                        <input type="email" name="mail" required="required" placeholder="Email Address">
                    </div>
                    <div class="form-item">
                        <label for="password"></label>
                        <input type="password" name="pass" required="required" placeholder="Password" id="password">
                    </div>
                    <div class="form-item">
                        <label for="confirm-password"></label>
                        <input type="password" name="confirm-password" required="required" placeholder="Confirm Password" id="confirm-password">
                    </div>
                    <div class="button-panel">
                        <input type="submit" class="button" title="Create Account" value="Create Account">
                    </div>
                </form>
                <div class="form-footer">
                    <p><a href="index.php">Already have an account? Sign in</a></p>
                </div>
            </div>
        </main>

        <aside>
            <!-- サイドバーに関する情報 -->
        </aside>

        <footer>
            <p>&copy; G08</p>
        </footer>

        <script src="js/CreateAccount.js"></script>
    </body>
</html>
