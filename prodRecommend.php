<?php 
//require('connection.inc.php');
//require('functions.inc.php');
require('recommend.php');


$uID = $_SESSION['USER_ID'] ?: null;

    if(!$uID==0)
    {
        $userID=$_SESSION['USER_ID'];

        $matrix=array();

        $reco=mysqli_query($con,"select * from userrating");

        while($rec=mysqli_fetch_array($reco))
        {       
            $users=mysqli_query($con,"select name from users where id=$rec[userID]");
            $username=mysqli_fetch_array($users);

            $matrix[$username['name']][$rec['pName']]=$rec['rating'];
        }
        
        $uName=mysqli_query($con,"select name from users where id='$userID'");

        $name=mysqli_fetch_array($uName);

        //var_dump(getRecommendation($matrix,$name['name']));
        
       

        $recommend=array();
        $recommend=getRecommendation($matrix,$name['name']);
      
        $getProd=mysqli_query($con,"select product.* from product"); 

        while($prod=mysqli_fetch_array($getProd)){
            $prodArr=$prod;
        
        foreach($recommend as $product=>$rating)  
            {      
                if($product==$prodArr['productName'])
                   {      
            ?>  
    <!-- Start Single Category -->

        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
            <div class="category">
                    <div class="ht__cat__thumb">
                            <a href="product.php?id=<?php echo $prodArr['id']?>">
                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$prodArr['image']?>" alt="product images">
                            </a>
                        </div>
                            <div class="fr__product__inner">
                        <h4><?php echo $product?></h4>
                        <ul class="fr__pro__prize">
                            <li class="old__prize"><?php echo $prodArr['mrp']?></li>
                            <li><?php echo $prodArr['price']?></li>
                        </ul>
                </div>
            </div>
        </div>
<?php
                    }
                }
            }
        }
    
     
        else
        {
            echo "login to get recommend";
        }
?> 


 