<?php 
session_start();
if(isset($_POST)){
    $betAmount = 10;
    $betInput = $_POST['bet_input'];
    $currentBalance = $_SESSION['user_balance'];
    if($currentBalance < $betAmount){
        echo json_encode(["status" => 401, "message" => "You dont have enough balance to play game."]);
        exit();
    }
    $dice1Output = rollDice();
    $dice2Output = rollDice();
    $totalOutput = $dice1Output + $dice2Output;
    if($betInput == 'below_7'){
        $winningAmount = $totalOutput < 7 ? 20 : 0;
    }else if($betInput == 'above_7'){
        $winningAmount = $totalOutput > 7 ? 20 : 0;
    }else {
        $winningAmount = $totalOutput == 7 ? 30 : 0;
    }
    $isWon = $winningAmount > 0 ? 1 : 0;
    $currentBalance = $currentBalance + $winningAmount - $betAmount;
    $_SESSION['user_balance'] = $currentBalance;
    $canPlayMore = $currentBalance >= $betAmount ? 1 : 0;
    $result = [
        'currentBalance' => $currentBalance,
        'winningAmount' => $winningAmount,
        'isWon' => $isWon,
        'dice1Output' => $dice1Output,
        'dice2Output' => $dice2Output,
        'totalOutput' => $totalOutput,
        'canPlayMore' => $canPlayMore,
    ];
    echo json_encode(["status" => 200, 'result' => $result]);
    exit();
}else{
    return "Invalid request";
}

function rollDice(){
    return rand(1,6);
}
?>