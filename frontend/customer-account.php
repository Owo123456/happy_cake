
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cake House 帶給你最天然健康的幸福滋味">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        Cake House : 帶給你最天然健康的幸福滋味
    </title>

    <meta name="keywords" content="">

    <?php require_once('template/head_files.php'); ?>


</head>

<body>
<?php require_once('template/navbar.php'); 
require_once('../function/connection.php');
$query = $db->query("SELECT * FROM members WHERE account='".$_SESSION['member']['account']."'");  //pageID是從網址列取得
$member = $query->fetch(PDO::FETCH_ASSOC);
?>

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="#">首頁</a>
                        </li>
                        <li>會員基本資料</li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">會員專區</h3>
                        </div>

                        <div class="panel-body">

                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="basket.php"><i class="fa fa-list"></i> 我的購物車</a>
                                </li>
                                <li>
                                    <a href="customer-orders.php"><i class="fa fa-heart"></i> 我的訂單</a>
                                </li>
                                <li class="active">
                                    <a href="customer-account.php"><i class="fa fa-user"></i> 我的資料</a>
                                </li>
                                <li>
                                    <a href="logout.php"><i class="fa fa-sign-out"></i> 登出</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** CUSTOMER MENU END *** -->
                </div>

                <div class="col-md-9">
                    <div class="box">
                        <h1>會員基本資料</h1>
                        <p class="lead">編輯您的會員資料</p>
                        <p class="text-muted">此資料協助我們寄送產品與提供更多優惠訊息，請務必填寫真實資料</p>
                        <?php if(isset($_GET['msg']) && $_GET['msg'] != null){ ?>
                        <div class="alert alert-success">
                            <strong>更新成功!</strong>
                        </div>
                        <?php } ?>
                        <h3>變更密碼</h3>

                        <form data-toggle="validator" action="change_password.php" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_old">舊密碼</label>
                                        <input type="password" class="form-control" id="password_old" name="password_old" placeholder="Password" data-error="請輸入舊密碼" required>
                                        <div class="help-block with-errors is_repeat"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_1">新密碼</label>
                                        <input type="password" class="form-control" id="password_new" name="password_new" data-minlength="6" placeholder="Password" data-error="請輸入至少六個字元的新密碼" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_2">再次輸入新密碼</label>
                                        <input type="password" class="form-control" id="password_check" name="password_check"  placeholder="Confirm" data-match="#password_new" data-match-error="密碼不符，請重新輸入!" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> 修改密碼</button>
                                
                            </div>
                            <input type="hidden" class="form-control" id="account2" name="account2" readonly>
                        </form>

                        <hr>

                        <h3>個人資料</h3>
                        <form action="update_account.php" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="account">帳號</label>
                                        <input type="text" class="form-control" id="account" name="account" value="<?php echo $member['account']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">姓名</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $member['name']; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="birthday">生日</label>
                                        <input type="text" class="form-control" id="birthday" name="birthday" value="<?php echo $member['birthday']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="gender">性別</label>
                                        <div class="form-control" style="border:none;">
                                        <?php if(isset($member['gender']) && $member['gender'] != null){?>
                                            <?php if( $member['gender'] == 1){?>
                                                <label class="radio-inline"><input type="radio" name="gender" value="1" checked>男</label>
                                                <label class="radio-inline"><input type="radio" name="gender" value="2" >女</label>
                                            <?php }else if($member['gender'] == 2){?>
                                                <label class="radio-inline"><input type="radio" name="gender" value="1">男</label>
                                                <label class="radio-inline"><input type="radio" name="gender" value="2" checked >女</label>
                                            <?php }?>
                                        <?php }else{?>
                                            <label class="radio-inline"><input type="radio" name="gender" value="1">男</label>
                                            <label class="radio-inline"><input type="radio" name="gender" value="2">女</label>
                                         <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div id="twzipcode">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="zip">郵遞區號</label>
                                            <input type="text" class="form-control" id="zipcode" name="zipcode" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="state">城市</label>
                                            <select class="form-control" id="county" name="county" value=""></select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="country">地區</label>
                                            <select class="form-control" id="district" name="district" value=""></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label for="city">地址</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $member['address']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">家用電話</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $member['phone']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="mobile">行動電話</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $member['mobile']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">備用Email</label>
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $member['email']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <input type="hidden" name="EditForm" value="UPDATE">
                                    <input type="hidden" name="memberID" value="<?php echo $member['memberID']; ?>">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> 更新資料</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


        <?php require_once('template/footer.php'); ?>
<script>
$(function(){
    $('#twzipcode').twzipcode({
        'zipcodeSel' : '<?php echo $member['zipcode']; ?>',
        'countySel' : '<?php echo $member['county']; ?>',
        'districtSel' : '<?php echo $member['district']; ?>'
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
