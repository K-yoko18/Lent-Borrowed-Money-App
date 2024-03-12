<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>借入者の詳細</title>
    <link rel="stylesheet" href="css/IndividualBorrowerDetails.css">
</head>
<body>
    <?php
        session_start();
        // sqlite接続
        $pdo = new PDO("mysql:dbname=wat2023;host=localhost;charset=utf8mb4", "wat2023", "1315KJ201");
        // $user_id=2;
        // $sql="SELECT * FROM `g08_DebtStatus` WHERE id IN(".$user_id.")";
        // //SELECT * FROM `g08_DebtStatus` WHERE user_id =10;
        // $result_rows=$pdo->query($sql);

        $mail = $_POST['mail'];
        $sql = "SELECT * FROM g08_user WHERE mail = :mail";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        $member = $stmt->fetch();
        $user_id=(int)$_SESSION['id'];

        // $result_list = $pdo->query('SELECT * FROM `g08_DebtStatus` WHERE user_id =10');
        $result_list = $pdo->query('SELECT * FROM `g08_DebtStatus` WHERE user_id =('.$user_id.')');

    ?>
    <header>
        <button onclick="location.href='borrowing.php'" class="back-button">戻る</button>
        <h1>借入者の詳細</h1>
    </header>

    <main>
        <table class="borrower-details">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>借りた日</th>
                    <th>借りた金額</th>
                    <th>現在の金額</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <!-- サーバーから取得したデータで動的に埋められる想定 -->

                <?php foreach ($result_list as $row): ?>
                    <?php
                        $id = $row['id'];
                        $name = $row['name'];
                        $start_date = $row['start_date'];
                        $debt = $row['debt'];
                        $rate=$row['interest_rate'];
                        $day=$row['interest_days'];
                        // 現在の日付を取得
                        $currentDate = date('Y-m-d');
                         // 日付の差を計算
                        $daysDiff = (strtotime($currentDate) - strtotime($start_date)) / (60 * 60 * 24);
                        // 計算した経過日数に基づいてmoneyの金額を更新
                        $newMoney = $debt * (1 + $rate / 100 * $daysDiff / $day);
                    ?>
                    <!-- テーブルの行を開始 -->
                    <tr>
                        <!-- 各行のセル（列） -->
                        <td><?= "{$name} <br>"?></td>
                        <td><?= "{$start_date} <br>"?></td>
                        <td><?= "{$debt} <br>"?></td>
                        <td><?= "{$newMoney} <br>"?></td>
                        <!-- <td><button class="repayment-button">返済</button></td> -->
                        <td><a href="delete.php?id=<?= $id ?>" class="repayment-button">返済</a></td>
                    </tr>
                <?php endforeach; ?>
                <!-- 他のレコード -->
            </tbody>
        </table>

    </main>

    <footer>
        <p>&copy;G08</p>
    </footer>

</body>
</html>
