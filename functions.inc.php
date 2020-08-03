<?php
function pr($arr){
    echo '<pre>';
    print_r($arr);
}

function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
}

function get_safe_value($con,$str){
    if(($str!='')){
        $str=trim($str);
    return mysqli_real_escape_string($con,$str);
    }
}

function get_product($con,$limit='',$catId='',$productId='',$pName=''){
    $sql="select product.*,categories.categories from product,categories where product.status=1 ";
    if($catId!=''){
        $sql.=" and product.categoriesId=$catId ";
    }
    if($productId!=''){
        $sql.=" and product.id=$productId ";
    }
    if($pName!=''){
        $sql.=" and product.productName=$pName where product.id=$productId ";
    }
    $sql.=" and product.categoriesId=categories.id ";
    $sql.=" order by product.id desc";

    if($limit!=''){
        $sql.=" limit $limit";
    }
    
    $res=mysqli_query($con,$sql);
    $data=array();
    while($row=mysqli_fetch_assoc($res)){
        $data[]=$row;
    }
    return $data;
}
?>