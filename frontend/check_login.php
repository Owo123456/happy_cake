<?php
    session_start();
    require_once('../function/connection.php');
    $query = $db->query("SELECT * From members WHERE account='".$_POST['account']."' AND password='".$_POST['password']."'");
    //echo "SELECT * From members WHERE account='".$_POST['account']."' AND password='".$_POST['password']."'"."<br>";
    $member = $query->fetch(PDO::FETCH_ASSOC);
    //print_r($member);
    echo "<br />";
    if(isset($member) && $member != null ){
        $_SESSION['member'] = $member;
        if(isset($_POST['url']) && $_POST['url'] == "basket"){
            header('Location: checkout1.php');
        }else{
            echo "<br />login";
            header('Location: customer-account.php');
        }
    }else{
        echo "<br />no_login";
        header('Location: login_error.php');
    }
    
?>