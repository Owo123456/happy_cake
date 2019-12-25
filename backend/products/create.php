<?php
  require_once('../is_login.php');
  require_once('../../function/connection.php');
  if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){

    if (!file_exists('../../uploads/products')) {     
      mkdir('../../uploads/products', 0755, true);    //只會執行一次  //0755可讀寫而已
    }


    if(isset($_FILES['picture']['name'])){    //$_FILES 為暫存圖片的
      $filename = $_FILES['picture']['name'];
      $file_path = "../../uploads/products/".$_FILES['picture']['name'];
      move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
    }else{
      $filename = "delicious_dessert.jpg";
    }

  $sql = "INSERT INTO products (product_categoryID, picture, price, name, description, created_at) VALUES ( :product_categoryID, :picture, :price, :name, :description, :created_at)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":product_categoryID", $_POST['product_categoryID'], PDO::PARAM_STR);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":price", $_POST['price'], PDO::PARAM_STR);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
  $sth ->bindParam(":created_at", $_POST['created_at'], PDO::PARAM_STR);
  $sth ->execute();
    
  //偵錯
  // echo $_POST['product_categoryID']."<br>";
  // echo $filename."<br>";
  // echo $_POST['price']."<br>";
  // echo $_POST['name']."<br>";
  // echo $_POST['description']."<br>";
  // echo $_POST['created_at']."<br>";

  header('Location: list.php?product_categoryID='.$_GET['product_categoryID']);
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
          <h1 class="mb-4">產品管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">產品管理</li>
            <li class="breadcrumb-item active">新增一筆</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="create.php?product_categoryID=<?php echo $_GET['product_categoryID']; ?>" enctype="multipart/form-data">
            <!--上傳圖片一定要加上enctype="multipart/form-data"-->
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">圖片</label>
              <div class="col-10">
                <input type="file" class="form-control-file" id="picture" name="picture"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">產品名稱</label>
              <div class="col-10">
                <input type="text" class="form-control" id="name" name="name"> </div>
            </div>
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">價格</label>
              <div class="col-10">
                <input type="text" class="form-control" id="price" name="price"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">描述</label>
              <div class="col-10">
                <textarea class="form-control" id="description" name="description"></textarea> </div>
            </div>
            <a class="btn btn-info" href="list.php?product_categoryID=<?php echo $_GET['product_categoryID']; ?>">取消並返回上一頁</a>
            <button type="submit" class="btn btn-success" onclick="if(!confirm('是否確定要新增此筆資料內容')){return false;};">確認送出</button>
            <!--以下為隱藏欄位，可用來偵錯-->
            <input type="hidden" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="AddForm" value="INSERT">
            <input type="hidden" name="product_categoryID" value="<?php echo $_GET['product_categoryID']; ?>">
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); //載入footer.php ?>
  <script>
  
  tinymce.init({
    selector: 'textarea#description',
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