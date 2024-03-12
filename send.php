<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>貸し借り確定</title>
    <link rel="stylesheet" href="css/CheckForm2.css">
</head>
<body>
    <header>
        <h1>貸し借り確定</h1>
    </header>
    <main>
    <div class="confirmation-wrapper">
        <p>以下の情報をDBへ登録しました</p>
        <div class="confirmation-details">
    <?php
        // session_start();
        // $dbh = new PDO("mysql:dbname=wat2023;host=localhost;charset=utf8mb4", "wat2023", "1315KJ201");
        // $mail = $_POST['mail'];
        // $sql = "SELECT * FROM g08_user WHERE mail = :mail";
        // $stmt = $dbh->prepare($sql);
        // $stmt->bindValue(':mail', $mail);
        // $stmt->execute();
        // $member = $stmt->fetch();

    try {
      session_start();
      //DB名、ユーザー名、パスワードを変数に格納
      $dsn = 'mysql:dbname=wat2023;host=localhost;charset=utf8mb4';
      $user = 'wat2023';
      $password = '1315KJ201';
    
      $PDO = new PDO($dsn, $user, $password); //PDOでMySQLのデータベースに接続

      $mail = $_POST['mail'];
      $sql = "SELECT * FROM g08_user WHERE mail = :mail";
      $stmt = $PDO->prepare($sql);
      $stmt->bindValue(':mail', $mail);
      $stmt->execute();
      $member = $stmt->fetch();

      //input.phpの値を取得
      $user_id = (int)$_SESSION['id'];
      $name = $_POST['name'];
      $debt = (int)$_POST['debt'];
      $interest_rate = (int)$_POST['interest_rate'];
      $interest_days = (int)$_POST['interest_days'];
      $start_date = date('Y-m-d'); // POSTされた日付文字列
    //   var_dump($user_id,$name,$debt,$interest_rate,$interest_days,$start_date);
    //   $start_date = new DateTime($start_date_str); // DateTimeオブジェクトに変換
    //   var_dump($user_id,$name,$debt,$interest_rate,$interest_days,$start_date);

      $sql = "INSERT INTO g08_DebtStatus(user_id,name,debt,interest_rate,interest_days,start_date)  VALUES (:user_id,:name,:debt,:interest_rate,:interest_days,:start_date)"; // テーブルに登録するINSERT INTO文を変数に格納　VALUESはプレースフォルダーで空の値を入れとく
      $stmt = $PDO->prepare($sql); //値が空のままSQL文をセット
      $params = array(':user_id'=> $user_id,':name'=> $name,':debt'=> $debt,':interest_rate'=> $interest_rate,':interest_days'=> $interest_days,':start_date'=> $start_date);
      $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行
    
      // 登録内容確認・メッセージ
    echo "<p>userid: " . $user_id . "</span></p>";
    echo "<p>名前: " . $name . "</span></p>";
    echo "<p>借りる金額: " . $debt . "</span></p>";
    echo "<p>金利％: " . $interest_rate . "</span></p>";
    echo "<p>金利日数: " . $interest_days . "</span></p>";
    echo "<p>今日の日付: " . $start_date . "</span></p>";
    echo '<p>上記の内容をデータベースへ登録しました。</p>';
    } catch (PDOException $e) {
      exit('データベースに接続できませんでした。' . $e->getMessage());
    }
    ?>
<div class="button-panel">
    <button onclick="location.href='borrowing.php'" class="button">OK</button>
</div>
</div>
</div>
</main>
</body>
</html>