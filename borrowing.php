<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>借入情報</title>
    <link rel="stylesheet" href="css/borrowing.css">
</head>
<body>
    <div class="content">
        <header>
        <?php
        session_start();
        $dbh = new PDO("mysql:dbname=wat2023;host=localhost;charset=utf8mb4", "wat2023", "1315KJ201");
        // var_dump($dbh);
        $mail = $_POST['mail'];
        // var_dump($mail);
        $sql = "SELECT * FROM g08_user WHERE mail = :mail";
        $stmt = $dbh->prepare($sql);
        // var_dump($stmt);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        $member = $stmt->fetch();
        echo "<h1>" . $_SESSION['name'] . "さんの借入情報</span></h1>";
        ?>
        </header>
    
        <nav>
            <!-- ナビゲーションメニュー -->
        </nav>
    
        <main>
            <div class="form-wrapper">
                <div class="button-panel">
                    <a href="MainBorrowing.php" class="button">借りる</a>
                    <a href="IndividualBorrowerDetails.php" class="button">状況確認</a>
                </div>
            </div>
        </main>
    
        <aside>
            <!-- サイドバー情報 -->
        </aside>
    
        <footer>
            <p>&copy; G08</p>
        </footer>
    
        <script src="js/borrowing.js"></script>
    </div>
</body>
</html>
