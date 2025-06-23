<?php
require "db_cake.php";  // 連接資料庫

// 取得表單資料
$mname = $_POST['username'] ?? '';  // 注意表單的 name 是 username 不是 mname！
$passwd = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';
$email = $_POST['email'] ?? '';
$nickname = $_POST['nickname'] ?? '';
$agree = $_POST['agree'] ?? '';

// 驗證欄位
if (!$mname || !$passwd || !$confirm || !$email || !$nickname || !$agree) {
    die("⚠ 請填寫所有欄位！");
}
if ($passwd !== $confirm) {
    die("⚠ 密碼與確認密碼不一致！");
}

// 密碼加密
$hashed = password_hash($passwd, PASSWORD_DEFAULT);

// 寫入資料表
$sql = "INSERT INTO member (mname, passwd, email, nickname) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $mname, $hashed, $email, $nickname);

if (mysqli_stmt_execute($stmt)) {
    echo "✅ 註冊成功！";
    header("refresh:2; url=20250602_SPA.html"); // 或跳轉你的一頁式網站首頁
} else {
    echo "❌ 發生錯誤：" . mysqli_error($link);
}
?>
