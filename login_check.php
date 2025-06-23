<?php
session_start();
require "db_cake.php";

header('Content-Type: application/json'); // 告訴前端我們回傳的是 JSON

$mname = $_POST['mname'] ?? '';
$passwd = $_POST['passwd'] ?? '';


if (!$mname || !$passwd) {
    echo "請輸入帳號與密碼";
    exit;
}

$sql = "SELECT * FROM member WHERE mname = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "s", $mname);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($passwd, $row['passwd'])) {
        $_SESSION['mname'] = $row['mname'];
        $_SESSION['nickname'] = $row['nickname'];   
        echo json_encode(["status" => "success", "nickname" => $_SESSION['nickname']]);

    } else {
        echo json_encode(['status' => 'error', 'message' => '密碼錯誤']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => '查無此帳號']);
}
if (!preg_match('/^[a-zA-Z0-9_]{4,20}$/', $mname)) {
    die("帳號格式不符");
}

if (strlen($passwd) < 6) {
    die("密碼至少需6碼");
}
?>
