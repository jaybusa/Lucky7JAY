<?php
echo "<pre>";
$gridSize = 4;
$coordinates = [];
for ($position = 1; $position <= 16; $position++){
    if($position <= $gridSize){
        $x = $position - 1;
        $coordinates[$position] = "(".$x.",0)";
    }else{
        $y = (int) ($position / $gridSize);
        $newposition = $position - ($y*$gridSize);
        if($y % 2 != 0){
            $x = $gridSize - $newposition;
        }else{
            $x = $gridSize + $newposition;
        }
        $coordinates[$position] = "(".$x.",".$y.")";
    }
}

print_r($coordinates);
die;
    


    // if($position < $gridSize){
    //     $y = 0;
    // }else{
    //     $y = (int) ($position / $gridSize);
    //     if($position % $gridSize == 0){
    //         $y--;  
    //     }    
    // }
    
    // $x = $position % $gridSize;
    // if($y % 2 != 0){
    //     if($y > 0){
    //         $x = $x + ($position % $y);  
    //     }else{
    //         $x = $x + 1;  
    //     }
        
    // }else{
    //     if($y > 0){
    //         $x = $x - ($position % $y);  
    //     }else{
    //         $x = $x - 1;  
    //     }
    // }
    // // }
    // // $x--;
    
    // $y;
    // if($x < 0){
    //     $x = $gridSize - 1;
    // }
    // echo $position ." => (".$x . "," . $y.")";
    // if($position % 4 == 0){
    //     echo "\n";
    // }   
    
// }
?>