<?php require('top.php')?>     
        <div class="body__overlay"></div>
        <!-- Start Category Area -->
        <section class="htc__category__area ptb--100">
            <div class="container">
            <div class="section__title--2 text-center">
                            <h2 class="title__line">Top Picks</h2>
                            <?php require('prodRecommend.php');?>
                        </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                        <br><br><br><br><h2 class="title__line">Products</h2>
                        </div>
                    </div>
                </div>
                
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">
                            <?php
                            $get_product=get_product($con,8);
                            foreach($get_product as $list){                            
                            ?>
                            <!-- Start Single Category -->
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id=<?php echo $list['id']?>">
                                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>" alt="product images">
                                        </a>
                                    </div>
                                    <div class="fr__product__inner">
                                        <h4><?php echo $list['productName']?></h4>
                                        <ul class="fr__pro__prize">
                                            <li class="old__prize"><?php echo $list['mrp']?></li>
                                            <li><?php echo $list['price']?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Category -->
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        <!-- End Category Area -->
        <!-- Start Product Area -->


                        

        
<?php require('footer.php')?>
       