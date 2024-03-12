document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('main-borrowing-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // フォームのデフォルトの送信動作を防止
        // フォームデータを取得
        const name = document.getElementById('name').value;
        const debt = document.getElementById('debt').value;
        const interest_rate = document.getElementById('interest_rate').value;
        const interest_days = document.getElementById('interest_days').value;
        // データをセッションストレージ（またはローカルストレージ）に保存
        sessionStorage.setItem('name', name);
        sessionStorage.setItem('debt', debt);
        sessionStorage.setItem('interest_rate', interest_rate);
        sessionStorage.setItem('interest_days', interest_days);
        // CheckForm.phpにリダイレクト
        //window.location.href = 'CheckForm.php';
        window.location.href = 'send.php';
    });
});
