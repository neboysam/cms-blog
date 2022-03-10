<?php include "db.php"; ?>
<?php session_start(); ?>

<?php

$_SESSION['username'] = null;
$_SESSION['user_role'] = null;
$_SESSION['password'] = null;
$_SESSION['user_email'] = null;

header("Location: ../index.php");

?>