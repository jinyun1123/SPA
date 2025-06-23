<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'db_cake';

$link = mysqli_connect($host, $user, $pass, $dbname);

if (!$link) {
    die("資料庫連線失敗：" . mysqli_connect_error());
}

// mysqli_set_charset($link, "utf8"); // 若需要設定編碼可打開這行
?>
