<?php
session_start();
session_unset();
session_destroy();
header("Location: login.html"); // 登出後導回登入頁
exit;
?>
