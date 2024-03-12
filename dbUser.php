<?php

    // エラーの扱い（デバッグ用・デフォルトでコメントアウト）
    function checkError($e){
        // エラーログファイルに出力
        //error_log(date('Y-m-d H:i:s')." Error:".$e->getMessage()."\n", 3, "db_error.log");
        // php内の呼び出した箇所に表示
        print("Error:".$e->getMessage());
    }

    // PDOを作成し返す
    function getPDO(){
        // sqlite接続
        $pdo = new PDO("mysql:dbname=wat2023;host=localhost;charset=utf8mb4", "wat2023", "1315KJ201");
        
        // SQL実行時にもエラーの代わりに例外を投げるように設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // 結果を常に連想配列形式で取得するように設定
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        // 生成したPDOを返す
        return $pdo;
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

    // 新規ユーザーの追加
    function addUser($user_name, $user_mail, $user_pass){
        try{
            // 結果用新id
            $newid = -1;

            // PDOを取得
            $pdo = getPDO();

            // トランザクション開始
            $pdo->beginTransaction();

            try {
                // ユーザーを追加するクエリ
                $sql = 'INSERT INTO g08_user(name, mail, pass) VALUES(?, ?, ?)';

                // クエリ文字列を渡しステートメントの準備
                $stmt = $pdo->prepare($sql);
                
                // クエリにセットする値用配列
                $values = array($user_name, $user_mail, encryptPass($user_mail, $user_pass));
                
                // ステートメントに値をセットし実行
                $stmt->execute($values);
                
                // 挿入された行のidを取得
                $newid = $pdo->lastInsertId('id');

                // トランザクションを完了しコミット
                $pdo->commit();

            // エラーが発生したら
            }catch (Exception $e) {
                // トランザクションを取り消してロールバック
                $pdo->rollBack();
                // エラーを上位に投げる
                throw $e;
            }

        // エラーが発生したら
        }catch (PDOException $e){
            // エラー内容を送る
            checkError($e);
            // -1を出力し終了
            return -1;
        }

        // 新idを返す
        return $newid;
    }

    // ユーザーIDを取得し返す
    function browseUserID($user_mail, $user_pass){
        try{
            // PDOを取得
            $pdo = getPDO();

            // ユーザー情報を取得するクエリ
            $sql = 'SELECT * FROM applicant WHERE mail=? AND pass=?';

            // クエリ文字列を渡しステートメントの準備
            $stmt = $pdo->prepare($sql);

            // クエリにセットする値用配列
            $values = array($user_mail, encryptPass($user_mail, $user_pass));

            // 値を渡しステートメントを実行
            $stmt->execute($values);

            // 結果用変数
            $userID = -1;

            // 結果の行数分繰り返し
            foreach($stmt as $row){
                // 各値をセットし結果行を作成
                $userID = $row["id"];
            }

        // エラーが発生したら
        }catch (PDOException $e){
            // エラー内容を送る
            checkError($e);
            // 空文字を出力し終了
            return "";
        }

        // 結果を返す
        return $userID;
    }

?>