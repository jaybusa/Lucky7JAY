<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky - 7</title>
    <script src="./JS/jquery-3.5.1.min.js"></script>
</head>
<?php
    session_start();
    $playCount = 1;
    $_SESSION['user_balance'] = 100;
?>
<body id="mainBody">
    <h2>Welcome to Lucky 7 Game</h2>
    <h4>Your current balance is : <?= $_SESSION['user_balance']; ?></h4>
    <br>
    <p>Place your bet (Rs 10):</p>
    <form method="POST" id="user_input_form<?=$playCount?>">
        <div style="display:flex;" id="game_input">
            <input type="radio" name="bet_input" id="below_7_<?=$playCount?>" value="below_7"> 
            <label for="below_7_<?=$playCount?>">[Below 7]</label>
            <input type="radio" name="bet_input" id="7_<?=$playCount?>" value="7"> 
            <label for="7_<?=$playCount?>">[7]</label>
            <input type="radio" name="bet_input" id="above_7_<?=$playCount?>" value="above_7"> 
            <label for="above_7_<?=$playCount?>">[Above 7]</label>
            <a href="javascript:void(0)" onclick="play()">[Play]</a>
        </div>
    </form>
</body>
<script>
    var playCount = "<?=$playCount?>";
    function play(){
        console.log(playCount);
        if($("#user_input_form"+playCount+" input[type='radio']:checked").val() == undefined){
            alert("please select 1 option to play game");
            return;
        }
        $.ajax({
            type: "POST",
            url: './rollDice.php',
            data: $('#user_input_form'+playCount).serialize(),
            success: function(resultString){
                result = JSON.parse(resultString);
                console.log(result);
                if(result.status == 401){
                    alert(result.status);
                    return;
                }
                if(result.status == 200){
                    var resultHtml = '<p>Game Result</p>';
                    resultHtml += '<p>Dice 1: '+ result.result.dice1Output +'</p>';
                    resultHtml += '<p>Dice 2: '+ result.result.dice2Output +'</p>';
                    resultHtml += '<p>Total: '+ result.result.totalOutput +'</p> <br>';
                    if(result.result.isWon == 1){
                        resultHtml += '<p>Congratulations! You win! Your balance is now '+result.result.currentBalance+' Rs.</p> <br>';
                    }else{
                        resultHtml += '<p>Oops! You loose! Your balance is now '+result.result.currentBalance+' Rs.</p> <br>';
                    }
                    resultHtml += '<a href="./index.php">[Reset and Play Again]</a>';
                    if(result.result.canPlayMore == 1){
                        resultHtml += '<a href="javascript:void(0);" onclick="PlayMore()">[Continue Playing]</a>';
                    }
                    $('#mainBody').append(resultHtml);
                    playCount = 1 + +playCount;
                }

            }
        })
    }

    function PlayMore(){
        $.ajax({
            type: "GET",
            url: './playMore.php?playcount='+playCount,
            success: function(resultString){
                $('#mainBody').html(resultString);
                
            }
        })
    }
</script>
</html>