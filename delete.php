<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>返済</title>
    <link rel="stylesheet" href="css/CheckForm3.css">
</head>
<body>
    <header>
        <h1>返済</h1>
    </header>
    <main>
    <div class="confirmation-wrapper">
        <div class="confirmation-details">
<?php

try {

    $dsn = 'mysql:dbname=wat2023;host=localhost;charset=utf8mb4';
    $user = 'wat2023';
    $password = '1315KJ201';
   
    $PDO = new PDO($dsn, $user, $password); //PDOでMySQLのデータベースに接続
    
    $stmt = $PDO->prepare('DELETE FROM `g08_DebtStatus` WHERE id = :id');

    $stmt->execute(array(':id' => $_GET["id"]));

    //echo "返済しました。";

} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}

?>
 <div class="text-center">
    <p>返済しました。</p>
</div>
<div class="button-panel">
    <button onclick="location.href='borrowing.php'" class="button">OK</button>
</div>
        
  </body>
</html>
