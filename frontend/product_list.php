
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
<?php require_once('template/navbar.php'); ?>
<!-- 資料集區段 -->

<?php
require_once('../function/connection.php');
if(isset($_GET['category_id'])&& $_GET['category_id'] != null){
    $query2 = $db->query("SELECT * From product_categories WHERE product_categoryID='".$_GET['category_id']."' Order By created_at DESC");
    $categories2 = $query2->fetch(PDO::FETCH_ASSOC);
}
if(isset($_GET['category_id'])&& $_GET['category_id'] != null){
    $query = $db->query("SELECT * From products WHERE product_categoryID='".$_GET['category_id']."' Order By created_at DESC");
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
}else{
    $query = $db->query("SELECT * From products Order By created_at DESC");
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!-- End 資料集區段 -->
    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="../index.php">首頁</a>
                        </li>
                        <li><a href="product_list.php">所有產品</a>
                        </li>
                            <?php 
                            if(isset($_GET['category_id']) && $_GET['category_id'] != null){ ?>
                            <li><a href="product_list.php?category_id=<?php echo $_POST['category_id']; ?>"><?php echo "產品分類 : ".$categories2['category']?></a></li>
                            
                            <?php }else{ ?>
                                <li>產品分類</li>
                            <?php } ?>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">產品分類</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                            <?php foreach($categories as $category){?>
                                <li>
                                    <a href="product_list.php?category_id=<?php echo $category['product_categoryID']?>"><?php echo $category['category']?><span class="badge pull-right"></span></a>
                                    
                                </li>
                            <?php } ?>

                            </ul>

                        </div>
                    </div>

                    
                    

                    <!-- *** MENUS AND FILTERS END *** -->

                    <div class="banner">
                        <a href="#">
                            <img src="../images/ad-banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                </div>

                <div class="col-md-9">

                    <div class="row">
                        <div class="col-sm-12">        
                        <?php foreach($products as $product){?>
                        <div class="col-sm-3">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"> <!--可能是翻轉圖片的前面圖片-->
                                            <a href="product.php?category_id=<?php echo $product['product_categoryID']; ?>&productID=<?php echo $product['productID']; ?>">
                                                <img src="../uploads/products/<?php echo $product['picture']; ?>" alt="picture" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">  <!--可能是翻轉圖片的後面圖片-->
                                            <a href="product.php?category_id=<?php echo $product['product_categoryID']; ?>&productID=<?php echo $product['productID']; ?>">
                                                <img src="../uploads/products/<?php echo $product['picture']; ?>" alt="picture" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="product.php?category_id=<?php echo $product['product_categoryID']; ?>&productID=<?php echo $product['productID']; ?>" class="invisible">
                                    <img src="../uploads/products/<?php echo $product['picture']; ?>" alt="picture" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="product.php?category_id=<?php echo $product['product_categoryID']; ?>&productID=<?php echo $product['productID']; ?>"><?php echo $product['name']; ?></a></h3>
                                    <?php if( $product['status'] == 2){ ?>
                                        <p class="price">
                                            <small><small><del>$NT <?php echo $product['price']; ?></del></small></small>
                                            　$NT <?php echo $product['sale']; ?>
                                        </p>
                                    <?php }else{ ?>
                                        <p class="price"><del></del> $NT <?php echo $product['price']; ?></p>
                                    <?php } ?>
                                </div>
                                <!-- /.text -->
                                <?php if( $product['status'] == 1){ ?>
                                    <div class="ribbon new">
                                        <div class="theribbon">NEW</div>
                                        <div class="ribbon-background"></div>
                                    </div>
                                <?php }else if( $product['status'] == 2){ ?>
                                <!-- /.ribbon -->
                                    <div class="ribbon sale">
                                        <div class="theribbon">SALE</div>
                                        <div class="ribbon-background"></div>
                                    </div>
                                <?php } ?>
                               
                            </div>
                            <!-- /.product -->
                        </div>
                        <?php } ?>
                   
                        </div>
                    </div>

                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


       <?php require_once('template/footer.php'); ?>





</body>

</html>