<?php
require_once('../is_login.php');
require_once('../../function/connection.php');
$query = $db->query("SELECT * FROM page WHERE pageID=1");  //pageID是從網址列取得
$one_page = $query->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['EditForm']) && $_POST['EditForm'] == "UPDATE"){
  $sql = "UPDATE page SET title=:title, content=:content, updated_at=:updated_at WHERE pageID=:pageID";  //記得加冒號
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":title" , $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content" , $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":updated_at" , $_POST['updated_at'], PDO::PARAM_STR);
  $sth ->bindParam(":pageID" , $_POST['pageID'], PDO::PARAM_INT);  //$_POST['pageID']的pageID'名稱要和name="pageID"的pageID一致 ，這兩個pageID也可以改abc
  $sth ->execute();
  
  //偵錯
  // echo $_POST['published_at']."<br>";
  // echo $_POST['title']."<br>";
  // echo $_POST['content']."<br>";
  // echo $_POST['updated_at']."<br>";
  // echo $_POST['pageID']."<br>";

  //還想留在本頁面
  //$query = $db->query("SELECT * FROM page WHERE pageID=".$_GET['pageID']);  //pageID是從網址列取得
  //$one_page = $query->fetch(PDO::FETCH_ASSOC);
  
  header('Location: update.php?pageID=1&Edit=success');
}else{
  $query = $db->query("SELECT * FROM page WHERE pageID=1");  //pageID是從網址列取得
  $one_page = $query->fetch(PDO::FETCH_ASSOC);
}
// if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){
//   $sql = "INSERT INTO page (published_at, title, content, created_at) VALUES ( :published_at, :title, :content, :created_at)";
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
          <h1 class="mb-4">關於我們管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">關於我們管理</li>
            <li class="breadcrumb-item active">編輯</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="update.php">
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">標題</label>
              <div class="col-10">
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $one_page['title']; ?>" readonly> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">內容</label>
              <div class="col-10">
                <textarea class="form-control" id="content" name="content"><?php echo $one_page['content']; ?></textarea> </div>
            </div>
            <a class="btn btn-info" href="javascript:history.go(-1)">取消並返回上一頁</a> <!--返回上一頁-->
            <button type="submit" class="btn btn-success"  >確認送出</button>
            <!--以下為隱藏欄位，可用來偵錯-->
            <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="EditForm" value="UPDATE">
            <input type="hidden" name="pageID" value="<?php echo $one_page['pageID']; ?>">
            <!--也可以用這個方法取得網址newID:  <input type="text" name="pageID" value="<?php //echo $_GET['pageID']; ?>">  -->
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
    Launch demo modal
  </button> -->

  <!-- Modal -->
  <div class="modal fade" id="InfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          OK
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
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

  <?php if(isset($_GET['Edit']) && $_GET['Edit']=="success"){ ?>
    <script>
      $(function(){
        $('#InfoModal').modal();
      });
    </script>
  <?php } ?>
  
</body>

</html>