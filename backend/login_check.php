<?php
    session_start();       // 一開始一定要加這一段 !
    require_once('../function/connection.php');
    $query = $db->query("SELECT * FROM admin WHERE account='".$_POST['account']."' AND password='".$_POST['password']."'");
    echo "SELECT * FROM admin WHERE account='".$_POST['account']."' AND password='".$_POST['password']."'"."<br>";      // ->這段使用於偵錯，有顯示 SQL語法 就代表ok
    $user = $query->fetch(PDO::FETCH_ASSOC);
    print_r("test=".$user."<br>");     // ->這段使用於偵錯，有顯示 test=Array 就代表登入ok，沒顯示代表輸入或資料有問題
             // $_SESSTION['user'] ->整個東西是一個變數 ， 
    if(isset($user) && $user['account'] != null){
        $_SESSION['user']=$user;
        header('Location: news/list.php');
    }else{
        header('Location: login.php?MSG=error');
    }
    
    // print_r($_SESSTION['user']);
    // print_r($_SESSTION['user']['account']."<br>".$_SESSTION['user']['password']."<br>");
    // 也可以用下面這個
    // print_r(user['account']."<br>".user['password']."<br>");

    // $_SESSTION['user']['account'] ->其實就等於 $user['account']
    // $_SESSTION['user']['password'] ->其實就等於 $user['password']

?>