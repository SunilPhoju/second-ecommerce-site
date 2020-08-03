<?php 
require('top.php');
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
    ?>
    <script>
        window.location.href='index.php';
    </script>
    <?php
}

$cartTotal=0;
foreach($_SESSION['cart'] as $key=>$val){
    $productArr=get_product($con,'','',$key);
    $price=$productArr[0]['price'];
    $qty=$val['qty'];
    $cartTotal=$cartTotal+($price*$qty);
}

if(isset($_POST['submit'])){
    
    $address=get_safe_value($con,$_POST['address']);
    $city=get_safe_value($con,$_POST['city']);
    $pincode=get_safe_value($con,$_POST['pincode']);
    $paymentType=get_safe_value($con,$_POST['paymentType']);
    $userID=$_SESSION['USER_ID'];
    $totalPrice=$cartTotal;
    $paymentStatus='pending';
    if($paymentStatus=='COD'){
        $paymentStatus='success';
    }
    $orderStatus='pending';
    $addedOn=date('Y-m-d h:i:s');

    mysqli_query($con,"insert into 
    orders(userID,address,city,pincode,paymentType,totalPrice,paymentStatus,orderStatus,addedOn)
    values('$userID','$address','$city','$pincode','$paymentType','$totalPrice','$paymentStatus','$orderStatus','$addedOn')"); 

    $orderId=mysqli_insert_id($con);

    foreach($_SESSION['cart'] as $key=>$val){
        $productArr=get_product($con,'','',$key);
        $price=$productArr[0]['price'];
        $qty=$val['qty'];

        mysqli_query($con,"insert into orderdetail(orderId,productID,qty,price)
        values('$orderId','$key','$qty','$price')");
       
    }
    unset($_SESSION['cart'])?>
    <script>
        window.location.href='thankyou.php';
    </script>
    <?php
}

?>       
<!-- Start Bradcaump area -->
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                    <?php 
                                    $accordion_class='accordion__title';
                                    if(!isset($_SESSION['USER_LOGIN'])){
                                    $accordion_class='accordion__hide';    
                                    ?>
                                    <div class="accordion__title">
                                        Checkout Method
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="login-form" method="post">
                                                            <h5 class="checkout-method__title">Login</h5>
                                                            <div class="single-input">
                                                                <input type="text" name="loginEmail" id="loginEmail" placeholder="Your Email*" style="width:100%">
                                                            </div>
                                                            <span class="fieldError" id="loginEmailError" style="color:red;"></span>
                                                            <div class="single-input">
                                                                <input type="password" name="loginPassword" id="loginPassword" placeholder="Your Password*" style="width:100%">
                                                            </div>
                                                            <span class="fieldError" id="loginPasswordError" style="color:red;"></span>
                                                            <p class="require">* Required fields</p>
                                                            <div class="dark-btn">
                                                                <button type="button" class="fv-btn" onclick="userLogin()">Login</button>
                                                            </div>
                                                            <p class="form-messege fieldError" style="color:red;"></p>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form action="#">
                                                            <h5 class="checkout-method__title">Register</h5>
                                                            <div class="single-input">
                                                                <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
                                                            </div>
                                                            <span class="fieldError" id="nameError" style="color:red;"></span>
															<div class="single-input">
                                                                <input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%">
                                                            </div>
															<span class="fieldError" id="emailError" style="color:red;"></span>
                                                            <div class="single-input">
                                                                <input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
                                                            </div>
                                                            <span class="fieldError" id="passwordError" style="color:red;"></span>
                                                            <div class="dark-btn">
                                                                <button type="button" onclick="userRegister()" class="fv-btn">Register</button>
                                                            </div>
                                                            <p class="form-messege fieldError"></p>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="<?php echo $accordion_class?>">
                                        Address Information
                                    </div>
                                    <form method="post">
                                        <div class="accordion__body">
                                                <div class="bilinfo">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="single-input">
                                                                <input type="text" name="address" placeholder="Street Address" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-input">
                                                                <input type="text" name="city" placeholder="City/State" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-input">
                                                                <input type="text" name="pincode" placeholder="Post code/ zip" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="<?php echo $accordion_class?>">
                                            payment information
                                        </div>
                                        <div class="accordion__body">
                                            <div class="paymentinfo">
                                                <div class="single-method">
                                                    COD <input type="radio" name="paymentType" value="COD" required/>
                                                    <!--COD<input type="radio" name="paymentType" value="COD"/>-->
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" name="submit" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
                            <?php
                                $cartTotal=0;
                                foreach($_SESSION['cart'] as $key=>$val){
                                $productArr=get_product($con,'','',$key);
                                $pname=$productArr[0]['productName'];
                                $mrp=$productArr[0]['mrp'];
                                $price=$productArr[0]['price'];
                                $image=$productArr[0]['image'];
                                $qty=$val['qty'];
                                $cartTotal=$cartTotal+($price*$qty);
                            ?>
                                <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>"/>
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname?></a>
                                        <span class="price"><?php echo $price*$qty?></span>
                                    </div>
                                    <div class="single-item__remove">
                                    <a href="javascript:void(0)" onclick="manageCart('<?php echo $key?>','remove')"><i class="icon-trash icons"></i></a>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price"><?php echo $cartTotal?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<?php require('footer.php')?>           