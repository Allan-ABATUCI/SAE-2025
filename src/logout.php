<?php
session_start();
require_once 'connexion.php';
  session_destroy();
  header("Location:login.php");
?>