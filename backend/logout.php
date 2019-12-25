<?php
    session_start();       // 一開始一定要加這一段 !
    unset($_SESSION['user']);
    header('Location: login.php?MSG=logout');
?>