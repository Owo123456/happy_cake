<?php
require_once('../is_login.php');
require_once('../../function/connection.php');  // ../../ 指上一層再上一層資料夾位置 連一次到 mysql資料庫
$query = $db->query("SELECT * From members Order By memberID");
$members = $query->fetchall(PDO::FETCH_ASSOC);   //fetchall 取出所有的資料 member的
//$member = $query->fetch(PDO::FETCH_ASSOC);   //fetch 取出一筆資料 member的
$total_Rows = count($members);


//print_r($members);  //列出members資料表所有的資料
?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once('../layouts/head.php'); //載入head.php ?>
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
            <li class="breadcrumb-item active">會員清單</li>
          </ul>
        </div>
        <div class="col-md-12" style="margin-bottom: 20px;">
          <a class="btn btn-info" href="create.php">新增一筆</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">帳號</th>
                <th scope="col">姓名</th>
                <th scope="col">email</th>
                <th scope="col">生日</th>
                <th scope="col">性別</th>
                <th scope="col">住家</th>
                <th scope="col">操作</th>
              </tr>
            </thead>
            <tbody>
            <?php if($total_Rows > 0){?>
              <?php foreach($members as $data){?>
              <tr>
                <td><?php echo $data['account']; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['email']; ?></td>
                <td><?php echo $data['birthday']; ?></td>
                <td>
                  <?php if( $data['gender'] == 1){
                            echo "男";
                        }else if( $data['gender'] == 2){
                            echo "女";
                        };
                    
                  ?>
                </td>
                <td><?php echo $data['zipcode']."　".$data['county'].$data['district'].$data['address']; ?></td>
                <td>
                  <!--<a class="btn btn-info" href="#">內容</a>-->
                  <a class="btn btn-info" href="update.php?memberID=<?php echo $data['memberID']; ?>">編輯</a>
                  <a class="btn btn-info" href="delete.php?memberID=<?php echo $data['memberID']; ?>" onclick="if(!confirm('是否確定刪除此筆資料?刪除後無法回復')){return false;};">刪除</a>
                </td>
              </tr>
              <?php }?>
            <?php }else{ ?>
              <td>
                目前並無資料，請新增一筆。
              </td>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); //載入footer.php ?>
</body>

</html>