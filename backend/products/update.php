<?php
require_once('../is_login.php');
require_once('../../function/connection.php');
// $query = $db->query("SELECT * FROM products WHERE productID=".$_GET['productID']);  //productID是從網址列取得
// $one_products = $query->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['EditForm']) && $_POST['EditForm'] == "UPDATE"){
  
  if (!file_exists('../../uploads/products')) {     
    mkdir('../../uploads/products', 0755, true);    //只會執行一次  //0755可讀寫而已
  }


  if(isset($_FILES['picture']['name']) && $_FILES['picture']['name']!= null){    //$_FILES 為暫存圖片的
    $filename = $_FILES['picture']['name'];
    $file_path = "../../uploads/products/".$_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
  }else{
    $filename = $_POST['oldpicture'];
  }

  $sql = "UPDATE products SET productID=:productID,  picture=:picture, price=:price, name=:name, description=:description, updated_at=:updated_at WHERE productID=:productID";  //記得加冒號
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":picture" , $filename, PDO::PARAM_STR);
  $sth ->bindParam(":price" , $_POST['price'], PDO::PARAM_STR);
  $sth ->bindParam(":name" , $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":description" , $_POST['description'], PDO::PARAM_STR);
  $sth ->bindParam(":updated_at" , $_POST['updated_at'], PDO::PARAM_STR);
  $sth ->bindParam(":productID" , $_POST['productID'], PDO::PARAM_INT);  //$_POST['productID']的productID'名稱要和name="productID"的productID一致 ，這兩個productID也可以改abc
  $sth ->execute();
  
  // //偵錯
  // echo $filename."<br>";
  // echo $_POST['oldpicture']."<br>";
  // echo $_POST['price']."<br>";
  // echo $_POST['name']."<br>";
  // echo $_POST['description']."<br>";
  // echo $_POST['updated_at']."<br>";
  // echo $_POST['productID']."<br>";

  //還想留在本頁面
  // $query = $db->query("SELECT * FROM products WHERE productID=".$_GET['productID']);  //productID是從網址列取得
  // $one_products = $query->fetch(PDO::FETCH_ASSOC);
  
  header('Location: list.php?product_categoryID='.$_POST['product_categoryID']);
}else{
  $query = $db->query("SELECT * FROM products WHERE productID=".$_GET['productID']);  //productID是從網址列取得
  $one_products = $query->fetch(PDO::FETCH_ASSOC);
}
// if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){
//   $sql = "INSERT INTO products (price, name, description, created_at) VALUES ( :price, :name, :description, :created_at)";
//   $sth = $db ->prepare($sql);
//   $sth ->bindParam(":price", $_POST['price'], PDO::PARAM_STR);
//   $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
//   $sth ->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
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
          <h1 class="mb-4">產品管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">產品管理</li>
            <li class="breadcrumb-item active">編輯</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="update.php?product_categoryID=<?php echo $_GET['product_categoryID']; ?>&productID=<?php echo $_GET['productID']; ?>"  enctype="multipart/form-data">
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">圖片</label>
              <div class="col-10 text-left">
                <img class="mb-2" src="../../uploads/products/<?php echo $one_products['picture']; ?>" width="250px" alt="">
                <input type="file" class="form-control-file" id="picture" name="picture"> 
                <!--以下為hidden隱藏欄位，可用來偵錯-->
                <input class="mt-2"type="hidden" name="oldpicture" value="<?php echo $one_products['picture']; ?>">  
              </div>
                
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">產品名稱</label>
              <div class="col-10">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $one_products['name']; ?>"> </div>
            </div>
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">價格</label>
              <div class="col-10">
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $one_products['price']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">描述</label>
              <div class="col-10">
                <textarea class="form-control" id="description" name="description"><?php echo $one_products['description']; ?></textarea> </div>
            </div>
            <a class="btn btn-info" href="list.php?product_categoryID=<?php echo $_GET['product_categoryID']; ?>">取消並返回上一頁</a>
            <button type="submit" class="btn btn-success" onclick="if(!confirm('是否確定要更新此筆資料內容')){return false;};">確認送出</button>
            <!--以下為hidden隱藏欄位，可用來偵錯-->
            <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="EditForm" value="UPDATE">
            <input type="hidden" name="product_categoryID" value="<?php echo $one_products['product_categoryID']; ?>">
            <input type="hidden" name="productID" value="<?php echo $one_products['productID']; ?>">
            <!--也可以用這個方法取得網址productID:  <input type="text" name="productID" value="<?php //echo $_GET['productID']?>">  -->
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