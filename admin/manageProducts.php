<?php
require('top.inc.php'); 
$categoriesId='';
$productName='';
$mrp='';
$price='';
$qty='';
$image='';
$shortDesc='';
$description='';
$metaTitle='';
$metaDesc='';
$metaKeyword='';

$msg='';
$image_required='required';

if(isset($_GET['id']) && $_GET['id']!=''){
    $image_required='';
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"select * from product where id='$id'");
    $check=mysqli_num_rows($res);

    if($check>0){
        $row=mysqli_fetch_assoc($res);

        $categoriesId=$row['categoriesId'];
        $productName=$row['productName'];
        $mrp=$row['mrp'];
        $price=$row['price'];
        $qty=$row['qty'];
        //$image=$image['image'];
        $shortDesc=$row['shortDesc'];
        $description=$row['description'];
        $metaTitle=$row['metaTitle'];
        $metaDesc=$row['metaDesc'];
        $metaKeyword=$row['metaKeyword'];
    }else{
        header('location:products.php');
        die();
    }
}

if(isset($_POST['submit'])){
    $categoriesId=get_safe_value($con,$_POST['categoriesId']);
    $productName=get_safe_value($con,$_POST['productName']);
    $mrp=get_safe_value($con,$_POST['mrp']);
    $price=get_safe_value($con,$_POST['price']);
    $qty=get_safe_value($con,$_POST['qty']);
    $shortDesc=get_safe_value($con,$_POST['shortDesc']);
    $description=get_safe_value($con,$_POST['description']);
    $metaTitle=get_safe_value($con,$_POST['metaTitle']);
    $metaDesc=get_safe_value($con,$_POST['metaDesc']);
    $metaKeyword=get_safe_value($con,$_POST['metaKeyword']);

    $res=mysqli_query($con,"select * from product where productName	='$productName'");
    $check=mysqli_num_rows($res);

        if($check>0){
            if(isset($_GET['id']) && $_GET['id']!=''){
                $getData=mysqli_fetch_assoc($res);
                if($id==$getData['id']){

                }
                else{
                    $msg="This product already exists in database";
                }
            }else{            
            $msg="This product already exists in database";
        }
    }

    if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
            $msg="Images need to be in png, jpg and jpeg format";
    }

    if($msg==''){
        
        if(isset($_GET['id']) && $_GET['id']!=''){
            if($_FILES['image']['name']!=''){
                $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'.$image);
                
                $update_sql="update product set categoriesId='$categoriesId',productName='$productName'
                ,mrp='$mrp',price='$price',qty='$qty',shortDesc='$shortDesc',description='$description'
                ,metaTitle='$metaTitle',metaDesc='$metaDesc',metaKeyword='$metaKeyword',image='$image' where id='$id'";
            }else{
                $update_sql="update product set categoriesId='$categoriesId',productName='$productName'
                ,mrp='$mrp',price='$price',qty='$qty',shortDesc='$shortDesc',description='$description'
                ,metaTitle='$metaTitle',metaDesc='$metaDesc',metaKeyword='$metaKeyword' where id='$id'";
            }
            mysqli_query($con,$update_sql);
        }else{
            $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'.$image);

            mysqli_query($con,"insert into product(categoriesId,productName,mrp,price,qty,shortDesc,description,metaTitle,metaDesc,metaKeyword,status,image) 
            values('$categoriesId','$productName','$mrp','$price','$qty','$shortDesc',
            '$description','$metaTitle','$metaDesc','$metaKeyword',1,'$image')");
        }    
        header('location:products.php');
        die();
    }
}
?>

        <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>

                        <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">

                                <div class="form-group">
                                    <label for="categories" class=" form-control-label">Categories</label>
                                    <select class="form-control" name="categoriesId">
                                        <option>Select Categories</option>
                                        <?php
                                        $res=mysqli_query($con,"select id,categories from categories order by categories asc");
                                            while($row=mysqli_fetch_assoc($res)){
                                                if($row['id']==$categoriesId){
                                                    echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                                                }else{

                                                }
                                                echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                    <div class="form-group">
                                    <label for="categories" class=" form-control-label">Product Name</label>
                                    <input type="text" name="productName" placeholder="Enter product Product Name" class="form-control" required value="<?php echo $productName?>">
                                    </div>

                                    <div class="form-group">
                                    <label for="categories" class=" form-control-label">MRP</label>
                                    <input type="text" name="mrp" placeholder="Enter product MRP" class="form-control" required value="<?php echo $mrp?>">
                                    </div>

                                    <div class="form-group">
                                    <label for="categories" class=" form-control-label">Price</label>
                                    <input type="text" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price?>">
                                    </div>

                                    <div class="form-group">
                                    <label for="categories" class=" form-control-label">Quantity</label>
                                    <input type="text" name="qty" placeholder="Enter product quantity" class="form-control" required value="<?php echo $qty?>">
                                    </div>

                                    <div class="form-group">
                                    <label for="categories" class=" form-control-label">Image</label>
                                    <input type="file" name="image" class="form-control" <?php echo 
                                    $image_required?>>
                                    </div>

                                    <div class="form-group">
                                    <label for="categories" class=" form-control-label">Short Description</label>
                                    <textarea name="shortDesc" placeholder="Enter short description of product" class="form-control" required><?php echo $shortDesc?></textarea>
                                    </div>

                                    <div class="form-group">
                                    <label for="categories" class=" form-control-label">Description</label>
                                    <textarea name="description" placeholder="Enter description of product" class="form-control" required><?php echo $description?></textarea>
                                    </div>

                                    <div class="form-group">
                                    <label for="categories" class=" form-control-label">Meta Title</label>
                                    <textarea name="metaTitle" placeholder="Enter Meta Title of product" class="form-control"><?php echo $metaTitle?></textarea>
                                    </div>

                                    <div class="form-group">
                                    <label for="categories" class=" form-control-label">Meta Description</label>
                                    <textarea name="metaDesc" placeholder="Enter meta description of product" class="form-control"><?php echo $metaDesc?></textarea>
                                    </div>

                                    <div class="form-group">
                                    <label for="categories" class=" form-control-label">Meta Keyword</label>
                                    <textarea name="metaKeyword" placeholder="Enter meta keyword of product" class="form-control"><?php echo $metaKeyword?></textarea>
                                    </div>

                                <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                                </button>
                                <div class="field_error"><?php echo $msg?></div>
                                </div>
                            </form>
                        
                         </div>
                  </div>
               </div>
            </div>
         </div>
    <div class="clearfix"></div>

<?php
require('footer.inc.php')
?>  