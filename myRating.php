<?php 
require('top.php');
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
                                                <th class="product-name">Your Ratings</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                        if(isset($_SESSION['USER_LOGIN'])){
                                            $userID=$_SESSION['USER_ID'];
                                            $result=mysqli_query($con,"select userrating.*,product.id, product.productName,product.image from userrating,product 
                                        where userrating.userID='$userID' and userrating.productID=product.id");
                                        while($row=mysqli_fetch_array($result))
                                        {
                                        ?>
                                        <tbody>
                                            <td><?php echo $row['productName']?></td>
                                            <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"></td>
                                            <td><?php echo $row['rating']?></td>
                                        </tbody>
                                        <?php } }?>
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        						
<?php require('footer.php')?>        