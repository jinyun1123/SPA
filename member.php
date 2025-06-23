<?php
session_start();
header("Content-Type: application/json");

if (isset($_SESSION['mname']) && isset($_SESSION['nickname'])) {
    echo json_encode(["loggedIn" => true, "nickname" => $_SESSION['nickname']]);
} else {
    echo json_encode(["loggedIn" => false]);
}

?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>會員專區</title>
</head>
<body>
  <h2>歡迎 <?php echo $_SESSION['mname']; ?> 回來！</h2>
  <a href="logout.php">登出</a>
</body>
</html>
