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
	require_once($homeDir . "scripts/game-script.php");
	require_once($homeDir . "classes/Board.php");
	require_once($homeDir . "classes/AI.php");
	require_once($homeDir . "classes/Human.php");
	require_once($homeDir . "layout/header.php");
	
	//set values for starting
	if(!isset($_SESSION["difficulty"]))
	{
		$_SESSION["difficulty"] = strtolower($title);
		$_SESSION["isGameOver"] = false;
		$_SESSION["results"] = "";
		$_SESSION["gameBoard"] = array
		(
			array
			(
				array(0,0,0,0),
				array(0,0,0,0),
				array(0,0,0,0),
				array(0,0,0,0)
			),
			array
			(
				array(0,0,0,0),
				array(0,0,0,0),
				array(0,0,0,0),
				array(0,0,0,0)
			),
			array
			(
				array(0,0,0,0),
				array(0,0,0,0),
				array(0,0,0,0),
				array(0,0,0,0)
			),
			array
			(
				array(0,0,0,0),
				array(0,0,0,0),
				array(0,0,0,0),
				array(0,0,0,0)
			)
		);
		
		$_SESSION["AI"] = new AI($difficulty);//Java("AI", $difficulty);
		
		//set player first when their turn is first
		if($_SESSION["playerTurn"] == 1)
		{
			if(isset($_SESSION["username"]))
			{
				$_SESSION["board"] = new Board(new Human($_SESSION["username"]), $_SESSION["AI"]); //Java("Board", new Java("Human", $_SESSION["username"]), $_SESSION["AI"]);
			}
			else
			{
				$_SESSION["board"] = new Board(new Human(""), $_SESSION["AI"]); //Java("Board", new Java("Human", ""), $_SESSION["AI"]);
			}
		}
		else
		{
			if(isset($_SESSION["username"]))
			{
				$_SESSION["board"] = new Board($_SESSION["AI"], new Human($_SESSION["username"])); //Java("Board", $_SESSION["AI"], new Java("Human", $_SESSION["username"]));
			}
			else
			{
				$_SESSION["board"] = new Board($_SESSION["AI"], new Human("")); //Java("Board", $_SESSION["AI"], new Java("Human", ""));
			}
			
			//AI moves first if player's turn is second
			//get move (AI)
			$move = $_SESSION["AI"]->getNextMove($_SESSION["board"]);
			$x = $move[0];
			$y = $move[1];
			$z = $move[2];
			
			//make move
			$_SESSION["gameBoard"][$x][$y][$z] = $_SESSION["board"]->getTurn();
			$_SESSION["board"]->makeMove($move);
		}
	}
	
	//cheating by changing difficulty
	if($_SESSION["difficulty"] !== strtolower($title) && !$_SESSION["isGameOver"])
	{
		incrementLosses();
		$_SESSION["isGameOver"] = true;
		$_SESSION["results"] = "You Lose (Cheating)";
	}
	
	//operate on xyz if set
	if(isset($_POST["x"]) && isset($_POST["y"]) && isset($_POST["z"]))
	{
		//get x, y, and z
		$x = (int)$_POST["x"];
		$y = (int)$_POST["y"];
		$z = (int)$_POST["z"];
		
		//cheating on position
		//if x, y, or z are out of bounds or game over
		if($x > 3 || $x < 0 || $y > 3 || $y < 0 || $z > 3 || $z < 0 || $_SESSION["isGameOver"])
		{
			//no double incrents
			if(!$_SESSION["isGameOver"])
			{
				incrementLosses();
				$_SESSION["isGameOver"] = true;
				$_SESSION["results"] = "You Lose (Cheating)";
			}
		}
		else if($_SESSION["gameBoard"][$x][$y][$z] == 0)
		{
			//make move
			$_SESSION["gameBoard"][$x][$y][$z] = $_SESSION["board"]->getTurn();
			$_SESSION["board"]->makeMove(array($x, $y, $z));//new Java("Location", $x, $y, $z));
			
			//get game state
			$state = $_SESSION["board"]->getState();
			
			//in progress
			if($state === 0);
			//game over
			if($state === 1)
			{
				//don't double increment wins or losses
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
			if($state === 2)
			{
				//don't double increment ties
				if(!$_SESSION["isGameOver"])
				{
					incrementTies();
					$_SESSION["isGameOver"] = true;
					$_SESSION["results"] = "Tie";
				}
			}
			
			//computer move until a valid move is selected
			$isValidMove = false;
			while(!$isValidMove && !$_SESSION["isGameOver"])
			{
				//get move (AI)
				$move = $_SESSION["AI"]->getNextMove($_SESSION["board"]);
				$x = $move[0];
				$y = $move[1];
				$z = $move[2];
				
				//make move
				if($_SESSION["gameBoard"][$x][$y][$z] === 0)
				{
					$_SESSION["gameBoard"][$x][$y][$z] = $_SESSION["board"]->getTurn();
					$_SESSION["board"]->makeMove($move);
					$isValidMove = true;
				}
			}
			
			//get game state
			$state = $_SESSION["board"]->getState();
			
			//in progress
			if($state === 0);
			//game over
			if($state === 1)
			{
				//don't double increment wins or losses
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
			if($state === 2)
			{
				//don't double increment ties
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
							
							echo ">";
							if($_SESSION["gameBoard"][$x][$y][$z] == 1)
							{
								echo "X";
							}
							else if($_SESSION["gameBoard"][$x][$y][$z] == 2)
							{
								echo "O";
							}
							else
							{
								echo "&nbsp;";
							}
							echo "</button>\n";
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