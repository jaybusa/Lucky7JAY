<?php
    session_start();
?>
<h2>Welcome to Lucky 7 Game</h2>
    <h4>Your current balance is : <?= $_SESSION['user_balance']; ?></h4>
    <br>
    <?php 
    $playCount= isset($_GET['playcount']) ? $_GET['playcount'] : 1;
    ?>
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
    <div id="game_output">

    </div>