<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snake and Lader</title>
    <script src="./JS/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div style="display:flex;">
        <div style="display:flex;">
            <h4>User Input</h4>
            <table border="1px">
                <tr>
                    <th>GRID</th>
                    <th><input type="number" name="grid_size" id="grid_size"></th>
                </tr>
            </table>
        </div>
        <div style="display:flex;margin-left:20%;margin-right:20%">
            <button onclick="startGame()">Start</button>
        </div>
        <div style="display:flex;">
            <table border="1px">
                <tr>
                    <th>PLAYERS</th>
                    <th>3</th>
                </tr>
            </table>
        </div>
    </div>
    <div id="result" ></div>
</body>
<script>
    function startGame(){
        if($("#grid_size").val() < 2){
            alert("please enter grid size more than 2.");
            return;
        }
        $.ajax({
            type: "POST",
            url: './play.php',
            data: {gridSize : $("#grid_size").val()},
            success: function(resultHtml){
                $('#result').html(resultHtml);

            }
        })
    }
</script>
</html>