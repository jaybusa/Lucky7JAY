<?php

if(isset($_POST)){

// echo "<pre>";
$gridSize  = $gridSize  = $_POST['gridSize'];;
$playersCount = 3;
$playersDiceHistory = [];
$playersPositionHistory = [];
$playersCoordinateHistory = [];
$winnerPlayer = 0;
$maxMove = $gridSize * $gridSize;
$i = 0;
// run dice for each players
do{
    
for($p = 1; $p <= $playersCount  ; $p++ ){
    $rollDice = rollDice();
    // add diced output to dice history
    $playersDiceHistory[$p][] = $rollDice;
    // print_r($playersDiceHistory);
    // add new position
    if(isset($playersPositionHistory[$p])){
        $lastPosition = end($playersPositionHistory[$p]);
        if($rollDice <= $maxMove - $lastPosition){
            $newPos =  $lastPosition + $rollDice;
            $playersPositionHistory[$p][] = $newPos;
            // calculate coordinates
            $playersCoordinateHistory[$p][] = getCoordinateByposition($newPos);
            // calculateUserCoordinates($p, $rollDice, $lastPosition);
            if($newPos == $maxMove){
                $winnerPlayer = $p;
            }
        }else{
            $playersPositionHistory[$p][] = $lastPosition;
            $playersCoordinateHistory[$p][] = end($playersCoordinateHistory[$p]);
        }
    }else{
        if($rollDice <= $maxMove){
            $playersPositionHistory[$p][] = $rollDice;
            $playersCoordinateHistory[$p][] = getCoordinateByposition($rollDice);
        }
    }

    if($winnerPlayer != 0){
        break;
    }
}
}while($winnerPlayer == 0);

$html = '<table border="1px">
    <tr>
        <th>Player No</th>
        <th>Dice Roll History</th>
        <th>Position History</th>
        <th>Coordinate History</th>
        <th>Winner status</th>
    </tr> ';
foreach($playersDiceHistory as $p => $history){
    if($p == $winnerPlayer){
        $winner = "Winner";
    }else{
        $winner = "";
    }
    $html .= '<tr>'
        .'<td>'.$p.'</td>'
        .'<td>'.implode(',', $history).'</td>'
        .'<td>'.implode(',', $playersPositionHistory[$p]).'</td>'
        .'<td>'.implode(',', $playersCoordinateHistory[$p]).'</td>'
        .'<td>'.$winner.'</td>'
    .'</tr>';
}
echo $html. '</table>';
}
// print_r([$playersDiceHistory, $playersPositionHistory]);
function rollDice(){
    return rand(1,6);
}

// function calculateUserCoordinates($userCount, $lastPosition,$rollDice){
//     global $playersCoordinateHistory;
//     global $gridSize;
//     if(isset($playersCoordinateHistory[$userCount])){
//         $lastCoordinate = end($playersCoordinateHistory[$userCount]);
//         $x = $lastCoordinate['x'];
//         $y = $lastCoordinate['y'];
        
//         if($y % 2 == 1){
//             // x decrease
//             if($rollDice < $gridSize){
//                 $x = $x - $rollDice;
//                 if($x < 0){
//                     $extraMove = $x * -1;
//                     $newYMove = ($extraMove / $gridSize) + 1;
//                     $y += $newYMove;
//                     if($newYMove % 2 == 0){
                        
//                     }
//                 }
//             }else{
//                 $y = 1;
//                 $remainingC = $rollDice % $gridSize; 
//                 $x = $gridSize - $remainingC;  // 
//             }    
//         }else{
//             // x increase

//         }
//         ($lastPosition / $gridSize > 1 &&)
//     }else{
//         $x = $y = 0;
//         if($rollDice < $gridSize){
//             $x = $rollDice-1;
//             $y = 0;
//         }else{
//             $y = 1;
//             $remainingC = $rollDice % $gridSize; 
//             $x = $gridSize - $remainingC;  // 
//         }
//     }
//     return ["x" => $x, "y" => $y];
// }

function getCoordinateByposition($position){
    global $gridSize;
    // if($position < $gridSize){
    if($position < $gridSize){
        $y = 0;
    }else{
        $y = (int) ($position / $gridSize);
        if($position % $gridSize == 0){
            $y--;  
        }    
    }
    
    $x = $position % $gridSize;
    if($y % 2 != 0){
        if($y > 0){
            $x = $x + ($position % $y);  
        }else{
            $x = $x + 1;  
        }
        
    }else{
        if($y > 0){
            $x = $x - ($position % $y);  
        }else{
            $x = $x - 1;  
        }
    }
    // }
    // $x--;
    
    $y;
    if($x < 0){
        $x = $gridSize - 1;
    }
    return "(".$x . "," . $y.")";
    // return ["x" => $x, "y" => $y];
}
?>