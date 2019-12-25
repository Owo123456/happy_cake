<?php
require_once('../is_login.php');
require_once('../../function/connection.php');
// $query = $db->query("SELECT * FROM news WHERE newsID=".$_GET['newsID']);  //newsID是從網址列取得
// $one_news = $query->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['EditForm']) && $_POST['EditForm'] == "UPDATE"){
  
  if (!file_exists('../../uploads/news')) {     
    mkdir('../../uploads/news', 0755, true);    //只會執行一次  //0755可讀寫而已
  }


  if(isset($_FILES['picture']['name']) && $_FILES['picture']['name']!= null){    //$_FILES 為暫存圖片的
    $filename = $_FILES['picture']['name'];
    $file_path = "../../uploads/news/".$_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
  }else{
    $filename = $_POST['oldpicture'];
  }

  $sql = "UPDATE news SET picture=:picture, published_at=:published_at, title=:title, content=:content, updated_at=:updated_at WHERE newsID=:newsID";  //記得加冒號
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":picture" , $filename, PDO::PARAM_STR);
  $sth ->bindParam(":published_at" , $_POST['published_at'], PDO::PARAM_STR);
  $sth ->bindParam(":title" , $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content" , $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":updated_at" , $_POST['updated_at'], PDO::PARAM_STR);
  $sth ->bindParam(":newsID" , $_POST['newsID'], PDO::PARAM_INT);  //$_POST['newsID']的newsID'名稱要和name="newsID"的newsID一致 ，這兩個newsID也可以改abc
  $sth ->execute();
  
  // //偵錯
  // echo $filename."<br>";
  // echo $_POST['oldpicture']."<br>";
  // echo $_POST['published_at']."<br>";
  // echo $_POST['title']."<br>";
  // echo $_POST['content']."<br>";
  // echo $_POST['updated_at']."<br>";
  // echo $_POST['newsID']."<br>";

  //還想留在本頁面
  // $query = $db->query("SELECT * FROM news WHERE newsID=".$_GET['newsID']);  //newsID是從網址列取得
  // $one_news = $query->fetch(PDO::FETCH_ASSOC);
  
  header('Location: list.php');
}else{
  $query = $db->query("SELECT * FROM news WHERE newsID=".$_GET['newsID']);  //newsID是從網址列取得
  $one_news = $query->fetch(PDO::FETCH_ASSOC);
}
// if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){
//   $sql = "INSERT INTO news (published_at, title, content, created_at) VALUES ( :published_at, :title, :content, :created_at)";
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
          <h1 class="mb-4">最新消息管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">最新消息管理</li>
            <li class="breadcrumb-item active">編輯</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="update.php?newsID=<?php echo $_GET['newsID']; ?>"  enctype="multipart/form-data">
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">圖片</label>
              <div class="col-10 text-left">
                <img class="mb-2" src="../../uploads/news/<?php echo $one_news['picture']; ?>" width="250px" alt="">
                <input type="file" class="form-control-file" id="picture" name="picture"> 
                <!--以下為hidden隱藏欄位，可用來偵錯-->
                <input class="mt-2"type="hidden" name="oldpicture" value="<?php echo $one_news['picture']; ?>">  
              </div>
                
            </div>
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">發佈日期</label>
              <div class="col-10">
                <input type="text" class="form-control" id="published_at" name="published_at" value="<?php echo $one_news['published_at']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">標題</label>
              <div class="col-10">
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $one_news['title']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">內容</label>
              <div class="col-10">
                <textarea class="form-control" id="content" name="content"><?php echo $one_news['content']; ?></textarea> </div>
            </div>
            <a class="btn btn-info" href="list.php">取消並返回上一頁</a>
            <button type="submit" class="btn btn-success" onclick="if(!confirm('是否確定要更新此筆資料內容')){return false;};">確認送出</button>
            <!--以下為hidden隱藏欄位，可用來偵錯-->
            <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="EditForm" value="UPDATE">
            <input type="hidden" name="newsID" value="<?php echo $one_news['newsID']; ?>">
            <!--也可以用這個方法取得網址newID:  <input type="text" name="newsID" value="<?php //echo $_GET['newsID']; ?>">  -->
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