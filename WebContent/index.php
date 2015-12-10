<?php
	$title="3D Tic-Tac-Toe";
	$homeDir="";
	require_once("layout/header.php");
	
	//unset game variables
	unset($_SESSION["difficulty"]);
	unset($_SESSION["isGameOver"]);
	unset($_SESSION["results"]);
?>
	<?php require_once("layout/scores.php");?>
    <div id="game">
    	<h1>3D Tic-Tac-Toe</h1>
    	<div id="center">
          <button value="Casual" onclick="location.href='game.php?difficulty=casual'">Casual</button>
          <button value="Easy" onclick="location.href='game.php?difficulty=easy'">Easy</button>
          <button value="Medium" onclick="location.href='game.php?difficulty=medium'">Medium</button>
          <button value="Hard" onclick="location.href='game.php?difficulty=hard'">Hard</button>
          <button value="Impossible" onclick="location.href='game.php?difficulty=impossible'">Impossible</button>
        </div>
    </div>
<?php
require_once("layout/footer.php");
?>