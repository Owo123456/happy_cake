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
$query = $db->query("SELECT * FROM order_details WHERE customer_orderID='".$_GET['customer_orderID']."' ORDER BY created_at DESC");
$customer_orders = $query->fetchAll(PDO::FETCH_ASSOC);
$query2 = $db->query("SELECT * FROM customer_orders WHERE customer_orderID='".$_GET['customer_orderID']."' ORDER BY created_at DESC");
$customer_orders2 = $query2->fetch(PDO::FETCH_ASSOC);

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
                    <li>訂單 # <?php echo $_GET['order_no']; ?></li>
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

                <div class="col-md-9" id="customer-order">
                    <div class="box">
                        <h1>訂單 #<?php echo $_GET['order_no']; ?></h1>
                        <p class="lead">訂單日期: <strong><?php echo $customer_orders2['created_at']; ?></strong> 成立，目前狀態為
                        
                            <?php if($customer_orders2['status'] == 0){ ?>
                                <strong><span class="label label-info">備貨中</span></strong>.</p>
                            <?php }else if($customer_orders2['status'] == 1){ ?>
                                <strong><span class="label label-success">出貨中</span></strong>.</p>
                            <?php }else if($customer_orders2['status'] == 2){ ?>
                                <strong><span class="label label-danger">待付款</span></strong>.</p>
                            <?php }else if($customer_orders2['status'] == 3){ ?>
                                <strong><span class="label label-warning">交易成功</span></strong>.</p>
                            <?php }else if($_GEcustomer_orders2T['status'] == 99){ ?>
                                <strong><span class="label label-primary">取消訂單</span></strong>.</p>
                            <?php } ?>
                        

                        
                        <p class="text-muted">有任何問題請 <a href="contact.php">聯絡我們</a>, 我們將盡快回覆您.</p>

                        <hr>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">產品</th>
                                        <th>數量</th>
                                        <th>單價</th>
                                        <th>小計</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total_price=0; foreach($customer_orders as $customer_order){?>
                                        <tr>
                                            <td>
                                                <a href="#">
                                                    <img src="../uploads/products/<?php echo $customer_order['picture']; ?>" alt="<?php echo $customer_order['name']; ?>">
                                                </a>
                                            </td>
                                            <td><?php echo $customer_order['name']; ?>
                                            </td>
                                            <td><?php echo $customer_order['quantity']; ?></td>
                                            <?php if( $customer_order['status'] == 2){ ?>
                                                <td>$NT <?php echo $customer_order['sale']; ?>　<small><small><del>$NT <?php echo $customer_order['price']; ?></del></small></small></td>
                                                <td>$NT <?php $sub_total = ($customer_order['sale']*$customer_order['quantity']); echo $sub_total; ?> </td>
                                            <?php }else{ ?>
                                                <td>$NT <?php echo $customer_order['price']; ?></td>
                                                <td>$NT <?php $sub_total= ($customer_order['price']*$customer_order['quantity']); echo $sub_total; ?> </td>
                                            <?php } ?>
                                        </tr>
                                    <?php $total_price += $sub_total ;} ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right">訂單總計</th>
                                        <th>$NT <?php echo $total_price; ?></th>
                                    </tr>
                                    <tr><?php if($total_price >= 2000){ ?>
                                        <th colspan="4" class="text-right">運費</th>
                                        <th>$NT <?php echo $customer_orders2['shipping']; ?></th>
                                        <?php }else{ ?>
                                        <th colspan="4" class="text-right">運費</th>
                                        <th>$NT <?php echo $customer_orders2['shipping']; ?>
                                        <?php } ?>
                                        
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-right">合計</th>
                                        <th>$NT <?php echo $total_price + $customer_orders2['shipping']; ?></th>
                                    </tr>

                                </tfoot>
                            </table>

                        </div>
                        <!-- /.table-responsive -->

                        <div class="row addresses">
                            <div class="col-md-12">
                                <h2>收件者資訊</h2>
                                <p>姓名：<?php echo $customer_orders2['name']; ?></p>
                                    <p>行動電話：<?php echo $customer_orders2['phone']; ?></p>
                                    <p>地址：<?php echo $customer_orders2['address']; ?></p>
                            </div>
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
