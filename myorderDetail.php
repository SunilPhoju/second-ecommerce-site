<?php 
require('top.php');
$orderId=get_safe_value($con,$_GET['id'])
?>
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Thank You</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Product Name</th>
                                                <th class="product-thumbnail">Product Image</th>
                                                <th class="product-name">Qty</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-price">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $uid=$_SESSION['USER_ID'];
                                               $res=mysqli_query($con,"select distinct(orderdetail.id),orderdetail.*,product.productName,product.image from orderdetail,product 
                                               ,orders where orderId='$orderId' and orders.userId='$uid' and orderdetail.productID=product.id");
                                               $totalPrice=0;
                                               while($row=mysqli_fetch_assoc($res)){
                                               $totalPrice=$totalPrice+($row['qty']*$row['price']); 
                                            ?>
                                            <tr>
                                                <td class="product-name"><?php echo $row['productName']?></td>
                                                <td class="product-name"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"></td>
                                                <td class="product-name"><?php echo $row['qty']?></td>
                                                <td class="product-name"><?php echo $row['price']?></td>  
                                                <td class="product-name"><?php echo $row['price']* $row['qty']?></td>                                                
                                            </tr>
                                               <?php } ?>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="product-name">Total Price</td>  
                                                <td class="product-name"><?php echo $totalPrice?></td>                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        						
<?php require('footer.php')?>        