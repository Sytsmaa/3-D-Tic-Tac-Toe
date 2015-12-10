<?php
	$title = "Impossible";
	$difficulty = 4;
	$homeDir = "";
	$game = true;
	$results = -1;
	
	if(isset($_GET["difficulty"]))
	{
		$fuckSytsma = $_GET["difficulty"];
		
		if($fuckSytsma === "casual")
		{
			$title = "Casual";
			$difficulty = 0;
		}
		else if($fuckSytsma === "easy")
		{
			$title = "Easy";
			$difficulty = 1;
		}
		else if($fuckSytsma === "medium")
		{
			$title = "Medium";
			$difficulty = 2;
		}
		else if($fuckSytsma === "hard")
		{
			$title = "Hard";
			$difficulty = 3;
		}
	}
	
	//required files
	require_once("layout/header.php");
	require_once("scripts/game-script.php");
	
	//set values for starting
	if(!isset($_SESSION["difficulty"]))
	{
		$_SESSION["difficulty"] = strtolower($title);
		$_SESSION["isGameOver"] = false;
		$_SESSION["results"] = "";
		
		if($_SESSION["playerTurn"] == 1)
		{
			$_SESSION["board"] = new Java("Board", new Java("Human", $_SESSION["username"]), new Java("AI", $difficulty));
		}
		else
		{
			$_SESSION["board"] = new Java("Board", new Java("AI", $difficulty), new Java("Human", $_SESSION["username"]));
		}
	}
	
	//cheating by changing difficulty
	if($_SESSION["difficulty"] !== strtolower($title) && !$_SESSION["isGameOver"])
	{
		incrementLosses();
		$_SESSION["isGameOver"] = true;
		$_SESSION["results"] = "You Lose (Cheating)";
	}
	
	//operate on xyz
	if(isset($_POST["x"]) && isset($_POST["y"]) && isset($_POST["z"]))
	{
		//get x, y, and z
		$x = $_POST["x"];
		$y = $_POST["y"];
		$z = $_POST["z"];
		
		//cheating on position
		//if x, y, or z are out of bounds
		if($x > 3 || $x < 0 || $y > 3 || $y < 0 || $z > 3 || $z < 0)
		{
			//no double incrents
			if(!$_SESSION["isGameOver"])
			{
				incrementLosses();
				$_SESSION["isGameOver"] = true;
				$_SESSION["results"] = "You Lose (Cheating)";
			}
		}
		else
		{
			//make move
			$_SESSION["board"]->makeMove(new Java("Location", $x, $y, $z));
			
			//get game state
			$state = $_SESSION["board"]->getState();
			
			//in progress
			if($state == 0);
			//game over
			if($state == 1)
			{
				if(!$_SESSION["isGameOver"])
				{
					$_SESSION["isGameOver"] = true;
					$turn = $_SESSION["board"]->getTurn();
					$_SESSION["results"] = "You " . $_SESSION["playerResults"][$turn - 1];
					if($_SESSION["playerTurn"] == $turn)
					{
						incrementWins();
					}
					else
					{
						incrementLosses();
					}
				}
			}
			//tie
			if($state == 2);
			{
				if(!$_SESSION["isGameOver"])
				{
					incrementTies();
					$_SESSION["isGameOver"] = true;
					$_SESSION["results"] = "Tie";
				}
			}
		}
	}
	
	
?>
	<?php require_once("layout/scores.php");?>
    <div id="game">
    	<h1>3D Tic-Tac-Toe</h1>
        Warning: Attempting to cheat may cause you to lose.
        <?php
			if($_SESSION["isGameOver"])
			{
				echo "<h1>" . $_SESSION["results"] . "</h1>\n";
			}
		?>
    	<div id="center">
        	<?php
				for($z = 0; $z < 4; $z++)
				{
					echo "<div id='buttonGrid'>";
					for($y = 0; $y < 4; $y++)
					{
						echo "<p>";
						for($x = 0; $x < 4; $x++)
						{
							echo "<button";
							
							if(!$_SESSION["isGameOver"])
							{
								echo " onclick='makeMove(\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?difficulty=" . $_SESSION["difficulty"] . "\", " . $x . ", " . $y . ", " . $z . ")'";
							}
							
							echo ">x</button>\n";
						}
						echo "</p>";
					}
					echo "</div>";
				}
				
				if($_SESSION["isGameOver"])
				{
					?>
                    <button onclick="location.href='index.php'">Choose Difficulty</button>
                    <?php
				}
			?>
        </div>
    </div>
<?php
require_once("layout/footer.php");
?>