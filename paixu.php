function testpaixu(){
        $arr = array("2",'1000','12','asdas','21');
        
        var_dump($this->px($arr));
    }
    function px($a){
        /*
        //冒泡
        $c = count($a);
        for($i=1;$i<$c;$i++){
            for($j=0;$j<$c-$i;$j++){
                if($a[$j] > $a[$j+1]){
                    $t = $a[$j+1];
                    $a[$j+1] = $a[$j];
                    $a[$j] = $t;
                }
            }
        }
        return $a;
        
       //选择
       $c = count($a);
       for($i=0;$i<$c-1;$i++){
        $p = $i;
            for($j=$i+1;$j<$c;$j++){
                if($a[$p] > $a[$j]){
                    $p = $j;
                }
            }
            if($i != $p){
                $t = $a[$p];
                $a[$p] = $a[$i];
                $a[$i] = $t;
            }

       }
       return $a;
       //插入
       $c = count($a);
       for ($i=1; $i < $c; $i++) { 
           $t = $a[$i];
           for ($j=$i-1; $j >= 0 ; $j--) { 
                if($t < $a[$j]){
                    $a[$j+1] = $a[$j];
                    $a[$j] = $t;
                    
                }else{
                    break;
                }
           }
       }
       return $a;*/
       //快速
       $c = count($a);
       if( $c <=1 ){
            return $a;
       }
       $t = $a[0];
       $left_a = array();
       $right_a = array();
       for ($i=1; $i < $c; $i++) { 
           if($t > $a[$i]){
                $left_a[] = $a[$i];
           }else{
                $right_a[] = $a[$i];
           }
       }
       $left_a = $this->px($left_a);
       $right_a = $this->px($right_a);
       return array_merge($left_a,array($t),$right_a);
    }

function xuanze($arr){
  $c = count($arr);
  for($i=0;$i<$c-1;$i++){
    $p = $i;
    for($j=$i+1;$j<$c;$j++){
      if($arr[p] > $arr[$j]){
        $p=$j;
      }
    }
    if($p!=$i){
      $tmp = $arr[$i];
      $arr[$i] = $arr[$p];
      $arr[$p] = $tmp;
    }
  }
}