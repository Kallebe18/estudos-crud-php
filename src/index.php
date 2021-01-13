<?php
  session_start();

  if($_SESSION['user']) {
    header('Location: http://localhost/home/index.php');
  } else {
    header('Location: http://localhost/session/login.php');
  }
?>