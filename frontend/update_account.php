<?php 
session_start();
require_once('../function/connection.php');
if(isset($_POST['EditForm']) && $_POST['EditForm'] == "UPDATE"){
    $sql = "UPDATE members SET name=:name, birthday=:birthday, gender=:gender, zipcode=:zipcode, county=:county, district=:district, address=:address, phone=:phone, mobile=:mobile, email=:email  WHERE memberID='".$_POST['memberID']."'";
    $sth = $db ->prepare($sql);
    $sth ->bindParam(":name" , $_POST['name'], PDO::PARAM_STR);
    $sth ->bindParam(":birthday" , $_POST['birthday'], PDO::PARAM_STR);
    $sth ->bindParam(":gender" , $_POST['gender'], PDO::PARAM_INT);  
    $sth ->bindParam(":zipcode" , $_POST['zipcode'], PDO::PARAM_STR);
    $sth ->bindParam(":county" , $_POST['county'], PDO::PARAM_STR);
    $sth ->bindParam(":district" , $_POST['district'], PDO::PARAM_STR);
    $sth ->bindParam(":address" , $_POST['address'], PDO::PARAM_STR);  
    $sth ->bindParam(":phone" , $_POST['phone'], PDO::PARAM_STR);
    $sth ->bindParam(":mobile" , $_POST['mobile'], PDO::PARAM_STR);
    $sth ->bindParam(":email" , $_POST['email'], PDO::PARAM_STR);  
    $sth ->execute();
    
    $_SESSION['member']['name'] = $_POST['name'];
    $_SESSION['member']['birthday'] = $_POST['birthday'];
    $_SESSION['member']['gender'] = $_POST['gender'];
    $_SESSION['member']['zipcode'] = $_POST['zipcode'];
    $_SESSION['member']['county'] = $_POST['county'];
    $_SESSION['member']['district'] = $_POST['district'];
    $_SESSION['member']['address'] = $_POST['address'];
    $_SESSION['member']['phone'] = $_POST['phone'];
    $_SESSION['member']['mobile'] = $_POST['mobile'];
    $_SESSION['member']['email'] = $_POST['email'];

    // echo $_POST['name']."<br>";
    // echo $_POST['birthday']."<br>";
    // echo $_POST['gender']."<br>";
    // echo $_POST['zipcode']."<br>";
    // echo $_POST['county']."<br>";
    // echo $_POST['district']."<br>";
    // echo $_POST['address']."<br>";
    // echo $_POST['phone']."<br>";
    // echo $_POST['mobile']."<br>";
    // echo $_POST['email']."<br>";
    $query = $db->query("SELECT * FROM members  WHERE memberID='".$_POST['memberID']."'");  //pageID是從網址列取得
    $member = $query->fetch(PDO::FETCH_ASSOC);

    header('Location: customer-account.php?Edit=success');
}else{
    $query = $db->query("SELECT * FROM members  WHERE memberID='".$_SESSION['member']['memberID']."'");  //pageID是從網址列取得
    $member = $query->fetch(PDO::FETCH_ASSOC);

    header('Location: customer-account.php?Edit=false');
}
?>