<?php
    require_once('../is_login.php');
    require_once('../../function/connection.php');
    $querly = $db ->query("DELETE FROM news WHERE newsID=".$_GET['newsID']);
    header('Location: list.php');
?>