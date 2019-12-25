<?php
    require_once('../function/connection.php');
    $query = $db->query("SELECT * FROM members WHERE account='".$_POST['account2']."' AND password='".$_POST['password_old']."'");
    echo ("SELECT * FROM members WHERE account='".$_POST['account2']."' AND password='".$_POST['password_old']."'");
    $data = $query->fetch(PDO::FETCH_ASSOC);

    if($data != null){
        echo "repeat";  //舊密碼相符
    }else if($_POST['password_old'] == null){
        echo "null";   
    }else{
        echo "no_repeat";   //舊密碼不相符
    }
?>