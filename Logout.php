<?php
  // v1: simple logout
  session_start();

  unset($_SESSION['UserID']);
  unset($_SESSION['UserRights']);
  session_destroy();
  header("Location:Login.php");

?>
