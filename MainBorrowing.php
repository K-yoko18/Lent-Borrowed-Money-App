<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お金を借りる</title>
    <link rel="stylesheet" href="css/MainBorrowing.css">
</head>
<body>
    <header>
        <button onclick="history.back()" class="back-button">戻る</button>
        <h1>お金を借りる</h1>
    </header>

    <main>
        <div class="form-wrapper">
            <form id="main-borrowing-form" action="send.php" method="POST">
                <!-- <div class="form-item">
                    <label for="user_id">ユーザID:</label>
                    <input type="number" name="user_id" required placeholder="ユーザIDを入力">
                </div> -->
                <div class="form-item">
                    <label for="name">名前:</label>
                    <input type="text"  name="name" required placeholder="名前を入力">
                </div>
                <div class="form-item">
                    <label for="debt">借りる金額:</label>
                    <input type="number" name="debt" required placeholder="金額を入力">
                </div>
                <div class="form-item">
                    <label for="interest_rate">金利％:</label>
                    <input type="number" name="interest_rate" step="1" required placeholder="金利を入力">
                </div>
                <div class="form-item">
                    <label for="interest_days">金利日数:</label>
                    <input type="number" name="interest_days" required placeholder="日数を入力">
                </div>
                <div class="button-panel">
                    <input type="submit" class="button" value="借りる">
                </div>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; G08</p>
    </footer>

    <!-- MainBorrowing.js スクリプトファイルのリンク -->
    <!-- <script src="js/MainBorrowing.js"></script> -->
</body>
</html>
