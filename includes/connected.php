<?php
if(!isset($_SESSION['email']) || isset($_SESSION['banni']))
    header('location:index.php');
?>