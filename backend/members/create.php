<?php
require_once('../is_login.php');
require_once('../../function/connection.php');
if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){
  $sql = "INSERT INTO members (level, account, password, name, phone, email, birthday, mobile, gender, zipcode, county, district, address, created_at) VALUES (:level, :account, :password, :name, :phone, :email, :birthday, :mobile, :gender, :zipcode, :county, :district, :address, :created_at)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":level", $_POST['level'], PDO::PARAM_INT);
  $sth ->bindParam(":account", $_POST['account'], PDO::PARAM_STR);
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

  header('Location: list.php');
}
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
            <li class="breadcrumb-item active">新增一筆</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right" id="twzipcode">
          <form id="c_form-h" class="" method="post" action="create.php">
            
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">level</label>
              <div class="col-10">
                <input type="text" class="form-control" id="level" name="level"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">帳號</label>
              <div class="col-10">
                <input type="text" class="form-control" id="account" name="account"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">密碼</label>
              <div class="col-10">
                <input type="text" class="form-control" id="password" name="password"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">姓名</label>
              <div class="col-10">
                <input type="text" class="form-control" id="name" name="name"> </div>
            </div>
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
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">電話</label>
              <div class="col-10">
                <input type="text" class="form-control" id="phone" name="phone"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">email</label>
              <div class="col-10">
                <input type="text" class="form-control" id="email" name="email"> </div>
            </div>
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">生日</label>
              <div class="col-10">
                <input type="text" class="form-control" id="birthday" name="birthday"> </div>
            </div>
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">手機</label>
              <div class="col-10">
                <input type="text" class="form-control" id="mobile" name="mobile"> </div>
            </div>
            
            <div class="form-group row" id="twzipcode">
                <label for="zip" class="col-2 col-sm-2 col-form-label form-group">郵遞區號</label>
                <div class="col-10 col-sm-2 form-group">
                  <input type="text" class="form-control" id="zipcode" name="zipcode">
                </div>

                <label for="state" class="col-2 col-sm-1 col-form-label form-group">縣市</label>
                <div class="col-10 col-sm-3  form-group">
                  <select class="form-control" id="county" name="county"></select>
                </div>

                <label for="district" class="col-2 col-sm-1 col-form-label form-group">地區</label>
                <div class="col-10 col-sm-3  form-group">
                  <select class="form-control" id="district" name="district"></select>
                </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-2 col-form-label">通訊地址</label>
              <div class="col-10">
                <textarea class="form-control" id="address" name="address"></textarea> </div>
            </div>
            <a class="btn btn-info" href="list.php">取消並返回上一頁</a>
            <button type="submit" class="btn btn-success" onclick="if(!confirm('是否確定要新增此筆資料內容')){return false;};">確認送出</button>
            <!--以下為隱藏欄位，可用來偵錯-->
            <input type="hidden" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="AddForm" value="INSERT">
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
        dateFormat: "mm月dd日",
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
    $('#twzipcode').twzipcode();
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