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


$query = $db->query("SELECT * FROM customer_orders WHERE memberID='".$_SESSION['member']['memberID']."' ORDER BY order_date DESC");
$customer_orders = $query->fetchAll(PDO::FETCH_ASSOC);


?>
    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="#">首頁</a>
                        </li>
                        <li>我的訂單</li>
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
                                <li class="active">
                                    <a href="customer-orders.php"><i class="fa fa-heart"></i> 我的訂單</a>
                                </li>
                                <li>
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

                <div class="col-md-9" id="customer-orders">
                    <div class="box">
                        <h1>我的訂單</h1>

                        <p class="lead">以下是您的訂單.</p>
                        <p class="text-muted">若有任何問題請至 <a href="contact.php">聯絡我們</a>填寫表單.</p>

                        <hr>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <?php 
                                
                                if(isset($customer_orders) && $customer_orders != null){?>
                                <thead>
                                    <tr>
                                        <th>訂單編號</th>
                                        <th>訂購日期</th>
                                        <th>總金額</th>
                                        <th>訂單狀態</th>
                                        <th>訂單明細</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    
                                    foreach($customer_orders as $customer_order){?>
                                    <tr>
                                        <th># <?php echo $customer_order['order_no']; ?></th>
                                        <td><?php echo $customer_order['order_date']; ?></td>
                                        <td><?php echo $customer_order['total']; ?></td>
                                        <td>
                                            <?php if(isset($customer_order['status']) && $customer_order['status'] != null){?>
                                                <?php if($customer_order['status'] == 0){ ?>
                                                    <span class="label label-info">備貨中</span>
                                                <?php }else if($customer_order['status'] == 1){ ?>
                                                    <span class="label label-success">出貨中</span>
                                                <?php }else if($customer_order['status'] == 2){ ?>
                                                    <span class="label label-danger">待付款</span>
                                                <?php }else if($customer_order['status'] == 3){ ?>
                                                    <span class="label label-warning">交易成功</span>
                                                <?php }else if($customer_order['status'] == 99){ ?>
                                                    <span class="label label-primary">取消訂單</span>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <span class="label label-info"> </span>
                                            <?php } ?>
                                        </td>

                                        <?php if($customer_order['status'] == 0){
                                            
                                            $order_date = str_replace("-","/",$customer_order['order_date']);
                                            ?>
                                        
                                        
                                        <?php } ?>
                                        <td>
                                        <div class="d-inline">
                                        <form id="formCreditCard" method="post" accept-charset="UTF-8" action="Payment_PHP-master/example/sample_Credit_CreateOrder.php">

                                            <input type="hidden" class="form-control" id="name" name="MerchantTradeNo" value="<?php echo $customer_order['order_no']; ?>">
                                            <input type="hidden" class="form-control" id="name" name="MerchantTradeDate" value="<?php echo $order_date; ?>">
                                            <input type="hidden" class="form-control" id="name" name="PaymentType" value="aio">
                                            <input type="hidden" class="form-control" id="name" name="TotalAmount" value="<?php echo $customer_order['total']; ?>">
                                            <input type="hidden" class="form-control" id="name" name="TradeDesc" value="Happy Cake 訂單#<?php echo $customer_order['order_no']; ?> 收件者：<?php echo $customer_order['name']; ?>">
                                            <input type="hidden" class="form-control" id="name" name="ClientBackURL" value="http://localhost/happy_cake_4/customer-orders.php">
                                            <input type="hidden" class="form-control" id="name" name="customer_orderID" value="<?php echo $customer_order['customer_orderID']; ?>">

                                            
                                            <a href="customer-order.php?order_no=<?php echo $customer_order['order_no']; ?>&customer_orderID=<?php echo $customer_order['customer_orderID']?>" class="btn btn-primary btn-sm">觀看詳細</a>
                                            <button type="submit" class="btn btn-danger btn-sm">去付款</button>
                                        </form>
                                        </div>
                                        <div class="d-inline">
                                        
                                        </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <?php }else{ ?>
                                <tbody>
                                    <tr colspan="5">目前沒有訂單</tr>
                                </tbody>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


        <?php require_once('template/footer.php'); ?>



</body>

</html>
