<?php
require_once('../is_login.php');
require_once('../../function/connection.php');
  if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){

    if (!file_exists('../../uploads/news')) {     
      mkdir('../../uploads/news', 0755, true);    //只會執行一次  //0755可讀寫而已
    }


    if(isset($_FILES['picture']['name'])){    //$_FILES 為暫存圖片的
      $filename = $_FILES['picture']['name'];
      $file_path = "../../uploads/news/".$_FILES['picture']['name'];
      move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
    }else{
      $filename = "delicious_dessert.jpg";
    }

  $sql = "INSERT INTO news (picture, published_at, title, content, created_at) VALUES ( :picture, :published_at, :title, :content, :created_at)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":published_at", $_POST['published_at'], PDO::PARAM_STR);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
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
          <h1 class="mb-4">最新消息管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">最新消息管理</li>
            <li class="breadcrumb-item active">新增一筆</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="create.php" enctype="multipart/form-data">
            <!--上傳圖片一定要加上enctype="multipart/form-data"-->
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">圖片</label>
              <div class="col-10">
                <input type="file" class="form-control-file" id="pict ure" name="picture"> </div>
            </div>
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">發佈日期</label>
              <div class="col-10">
                <input type="text" class="form-control" id="published_at" name="published_at"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">標題</label>
              <div class="col-10">
                <input type="text" class="form-control" id="title" name="title"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">內容</label>
              <div class="col-10">
                <textarea class="form-control" id="content" name="content"></textarea> </div>
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
  <script>
  $(function(){
      $("#published_at").datepicker({   //datepicker外掛
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
</body>

</html>