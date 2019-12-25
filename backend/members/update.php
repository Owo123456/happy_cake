<?php
require_once('../is_login.php');
require_once('../../function/connection.php');
$query = $db->query("SELECT * FROM members WHERE memberID=".$_GET['memberID']);  //memberID是從網址列取得
$one_member = $query->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['EditForm']) && $_POST['EditForm'] == "UPDATE"){
  $sql = "UPDATE members SET level=:level,  password=:password, name=:name, phone=:phone, email=:email, birthday=:birthday, mobile=:mobile, gender=:gender, zipcode=:zipcode, county=:county, district=:district, address=:address, created_at=:created_at, WHERE memberID=:memberID";  //記得加冒號
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":level", $_POST['level'], PDO::PARAM_INT);
  $sth ->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
  $sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
  $sth ->bindParam(":birthday", $_POST['birthday'], PDO::PARAM_STR);
  $sth ->bindParam(":mobile", $_POST['mobile'], PDO::PARAM_STR);
  $sth ->bindParam(":gender", $_POST['gender'], PDO::PARAM_INT);
  $sth ->bindParam(":zipcode", $_POST['zipcode'], PDO::PARAM_STR);
  $sth ->bindParam(":county", $_POST['county'], PDO::PARAM_STR);
  $sth ->bindParam(":district", $_POST['district'], PDO::PARAM_STR);
  $sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
  $sth ->bindParam(":created_at", $_POST['created_at'], PDO::PARAM_STR);
  $sth ->execute();
  
  //偵錯
  // echo $_POST['published_at']."<br>";
  // echo $_POST['title']."<br>";
  // echo $_POST['content']."<br>";
  // echo $_POST['updated_at']."<br>";
  // echo $_POST['memberID']."<br>";

  //還想留在本頁面
  //$query = $db->query("SELECT * FROM member WHERE memberID=".$_GET['memberID']);  //memberID是從網址列取得
  //$one_member = $query->fetch(PDO::FETCH_ASSOC);
  
  header('Location: list.php');
}else{
  $query = $db->query("SELECT * FROM members WHERE memberID=".$_GET['memberID']);  //memberID是從網址列取得
  $one_member = $query->fetch(PDO::FETCH_ASSOC);
}
// if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){
//   $sql = "INSERT INTO member (published_at, title, content, created_at) VALUES ( :published_at, :title, :content, :created_at)";
//   $sth = $db ->prepare($sql);
//   $sth ->bindParam(":published_at", $_POST['published_at'], PDO::PARAM_STR);
//   $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
//   $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
//   $sth ->bindParam(":created_at", $_POST['created_at'], PDO::PARAM_STR);
//   $sth ->execute();

//   header('Location: list.php');
// }
?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once('../layouts/head.php'); //載入head.php?>
  
</head>

<body>
  <?php include_once('../layouts/nav.php'); //載入nav.php?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="mb-4">會員管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">會員管理</li>
            <li class="breadcrumb-item active">編輯</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="update.php?memberID=<?php echo $_GET['memberID']; ?>">
            <div class="form-group row">
              <label for="level" class="col-2 col-form-label">level</label>
              <div class="col-10">
                <input type="text" class="form-control" id="level" name="level" value="<?php echo $one_member['level']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="account" class="col-2 col-form-label">帳號</label>
              <div class="col-10">
                <input type="text" class="form-control" id="account" name="account" value="<?php echo $one_member['account']; ?>" readonly> </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-2 col-form-label">密碼</label>
              <div class="col-10">
                <input type="text" class="form-control" id="password" name="password" value="<?php echo $one_member['password']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-2 col-form-label">姓名</label>
              <div class="col-10">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $one_member['name']; ?>"> </div>
            </div>
            <?php if(isset($one_member['gender']) && $one_member['gender'] != null){?>
              <?php if($one_member['gender'] == 1){?>
                  <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">性別</label>
                    <div class="col-10 text-left">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="1" checked>
                        <label class="form-check-label col-form-label" for="gender1">男</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="2">
                        <label class="form-check-label col-form-label" for="gender2">女</label>
                      </div>
                    </div>
                  </div>
              <?php }else if($one_member['gender'] == 2){ ?>
                  <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">性別</label>
                    <div class="col-10 text-left">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="1">
                        <label class="form-check-label col-form-label" for="gender1">男</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="2" checked>
                        <label class="form-check-label col-form-label" for="gender2">女</label>
                      </div>
                    </div>
                  </div>
              <?php } ?>
            <?php }else{ ?>
                  <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">性別</label>
                    <div class="col-10 text-left">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="1">
                        <label class="form-check-label col-form-label" for="gender1">男</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="2">
                        <label class="form-check-label col-form-label" for="gender2">女</label>
                      </div>
                    </div>
                  </div>
              <?php } ?>
            <div class="form-group row">
              <label for="phone" class="col-2 col-form-label">電話</label>
              <div class="col-10">
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $one_member['phone']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-2 col-form-label">email</label>
              <div class="col-10">
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $one_member['email']; ?>"> </div>
            </div>
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">生日</label>
              <div class="col-10">
                <input type="text" class="form-control" id="birthday" name="birthday" value="<?php echo $one_member['birthday']; ?>"> </div>
            </div>
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">手機</label>
              <div class="col-10">
                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $one_member['mobile']; ?>"> </div>
            </div>
            <div class="form-group row" id="twzipcode">
                <label for="zipcode" class="col-2 col-sm-2 col-form-label form-group">郵遞區號</label>
                <div class="col-10 col-sm-2 form-group">
                  <input type="text" class="form-control" id="zipcode" name="zipcode" value="">
                </div>
                <label for="county" class="col-2 col-sm-1 col-form-label form-group">縣市</label>
                <div class="col-10 col-sm-3  form-group">
                  <select class="form-control" id="county" name="county" value=""></select>
                </div>
                <label for="district" class="col-2 col-sm-1 col-form-label form-group">地區</label>
                <div class="col-10 col-sm-3  form-group">
                  <select class="form-control" id="district" name="district" value=""></select>
                </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-2 col-form-label">通訊地址</label>
              <div class="col-10">
                <textarea class="form-control" id="address" name="address"><?php echo $one_member['address']; ?></textarea> </div>
            </div>
            <a class="btn btn-info" href="list.php">取消並返回上一頁</a>
            <button type="submit" class="btn btn-success" onclick="if(!confirm('是否確定要更新此筆資料內容')){return false;};">確認送出</button>
            <!--以下為隱藏欄位，可用來偵錯-->
            <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="EditForm" value="UPDATE">
            <input type="hidden" name="memberID" value="<?php echo $one_member['memberID']; ?>">
            <!--也可以用這個方法取得網址newID:  <input type="text" name="memberID" value="<?php //echo $_GET['memberID']?>">  -->
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); //載入footer.php ?>
  <script src="../../js/jquery.twzipcode.min.js"></script>
  <script>
  $(function(){
      $("#birthday").datepicker({   //datepicker外掛
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
      });
  });
  
  tinymce.init({
    selector: 'textarea#content',
    height: 500,
    menubar: false,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
    ' bold italic backcolor | alignleft aligncenter ' +
    ' alignright alignjustify | bullist numlist outdent indent |' +
    ' removeformat | help',
    content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tiny.cloud/css/codepen.min.css'
    ]
  });
  </script>
  <script>
  
$(function(){
    $('#twzipcode').twzipcode({
        'zipcodeSel' : '<?php echo $one_member["zipcode"]; ?>',
        'countySel' : '<?php echo $one_member["county"]; ?>',
        'districtSel' : '<?php echo $one_member["district"]; ?>'
    });
    $('#twzipcode').find('input[name="zipcode"]').eq(1).remove();
    $('#twzipcode').find('select[name="county"]').eq(1).remove();
    $('#twzipcode').find('select[name="district"]').eq(1).remove();
    $('#birthday').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: "1950:2000"
    });

});
</script>
</body>

</html>