<?php
	$title="3D Tic-Tac-Toe";
	$homeDir="";
	require_once("layout/header.php");
	
	//unset game variables
	unset($_SESSION["difficulty"]);
	unset($_SESSION["isGameOver"]);
	unset($_SESSION["results"]);
	unset($_SESSION["board"]);
	
	//set player turn
	if(!isset($_SESSION["playerTurn"]))
	{
		$_SESSION["playerTurn"] = 1;
		$_SESSION["playerResults"] = array("Win", "Lose");
	}
	else
	{
		//swap turn
		$_SESSION["playerTurn"] = ($_SESSION["playerTurn"] % 2) + 1;
		
		//swap results
		$swap = $_SESSION["playerResults"][0];
		$_SESSION["playerResults"][0] = $_SESSION["playerResults"][1];
		$_SESSION["playerResults"][1] = $swap;
	}
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
          Warning: Impossible may time out.
        </div>
    </div>
<?php
require_once("layout/footer.php");
?>