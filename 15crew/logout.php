<?php
require_once "../includes/main.php";
unset($_SESSION['cm_superuser']);
unset($_SESSION['cm_superpass']);
session_write_close();
header("location:index.php");
?>