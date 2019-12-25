<?php
session_start();
$index = $_GET['CartID'];
unset($_SESSION['Cart'][$index]);                     //刪除$_SESSION['Cart'][陣列裡面的第幾個值]
$_SESSION['Cart'] = array_values($_SESSION['Cart']);  //重新陣列裡的整理索引值

header('Location: ../basket.php?Del=true');
?>