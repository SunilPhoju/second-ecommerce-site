<?php
function similarityDistance($matrix,$product1,$product2)
{
    
    $similar=array();
    $sum=0;
    
    foreach($matrix[$product1] as $key=>$value)
    {
        if(array_key_exists($key,$matrix[$product2]))
        {
            $similar[$key]=1;
        }
        
    }
        if($similar==0)
        {
            return 0;
        }
        

    foreach($matrix[$product1] as $key=>$value)
    {
        
        if(array_key_exists($key,$matrix[$product2]))
        {
            $sum=$sum+pow($value - $matrix[$product2][$key],2);
        }
    }
    return 1/(1+sqrt($sum));
    
}

function getRecommendation($matrix,$prod)
{
    $total=array();
    $simSums=array();
    $ranks=array();
    foreach($matrix as $otherProduct=>$value)
    {
        if($otherProduct!=$prod)
        {
            $sim=similarityDistance($matrix,$prod,$otherProduct);
            
            foreach($matrix[$otherProduct] as $key=>$value)
            {
                if(!array_key_exists($key,$matrix[$prod]))
                {
                    if(!array_key_exists($key,$total))
                    {
                        $total[$key]=0;
                    }
                    $total[$key]+=$matrix[$otherProduct] [$key]*$sim;

                    if(!array_key_exists($key,$simSums))
                    {
                        $simSums[$key]=0;
                    }
                    $simSums[$key]+=$sim;
                }
            }
        }
        
    }
    foreach($total as $key=>$value)
    {
        $ranks[$key]=$value/$simSums[$key];

    }
    array_multisort($ranks,SORT_DESC);
    return $ranks;
    //return $sim;
}
?>
