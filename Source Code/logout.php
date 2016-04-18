<?PHP
session_start();
session_destroy();
header("location:login.php?msg=2");
?>