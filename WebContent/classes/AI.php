<?php
require_once($homeDir . "classes/Piece.php");
require_once($homeDir . "classes/X.php");
require_once($homeDir . "classes/O.php");
require_once($homeDir . "classes/Board.php");
require_once($homeDir . "classes/Location.php");
require_once($homeDir . "classes/Player.php");

class AI implements Player
{
	/**
	* The simplest AI level. This AI just plays randomly and won't even attempt to win.
	* It's like playing a two year old.
	*/
	public $AI_LEVEL_CASUAL = 0;
	
	/**
	* The simple AI level. This AI just plays randomly, and will
	* only attempt to win if it manages to have all but one piece
	* in a line.
	*/
	public $AI_LEVEL_EASY = 1;
	
	/**
	* This AI level will most of the time block the player, but
	* will sometimes suffer from tunnel vision and miss a block.
	*/
	public $AI_LEVEL_MEDIUM = 2;
	
	/**
	* This AI level will always block the player if the player is about
	* to win. Therefore, the player has to have multiple ways of winning
	* to beat the AI.
	*/
	public $AI_LEVEL_HARD = 3;
	
	/**
	* The hardest AI level. This AI cannot be beaten, only tied with.
	*/
	public $AI_LEVEL_IMPOSSIBLE = 4;
	
	//Private fields about the AI
	private $level;
	private $piece;
	
	/**
	 * The default constructor for an AI. Assumes medium difficulty
	 */
	public function __constructor()
	{
		//We'll assume medium is the default, just in case.
		self::__constructor2(AI_LEVEL_MEDIUM);
	}
	
	/**
	 * Constructor for the AI
	 * @param level The level the AI will be. These are statically defined in the AI class
	 */
	public function __constructor2($level)
	{
		//This is to make sure a valid level is passed
		switch($level)
		{
			case $this->AI_LEVEL_CASUAL:
				$this->level = $this->AI_LEVEL_CASUAL;
				break;
			case $this->AI_LEVEL_EASY:
				$this->level = $this->AI_LEVEL_EASY;
				break;
			case $this->AI_LEVEL_MEDIUM:
				$this->level = $this->AI_LEVEL_MEDIUM;
				break;
			case $this->AI_LEVEL_HARD:
				$this->level = $this->AI_LEVEL_HARD;
				break;
			case $this->AI_LEVEL_IMPOSSIBLE:
			default:
				$this->level = $this->AI_LEVEL_IMPOSSIBLE;
		}
	}
	
	/**
	 * Get the username for the AI.
	 * @return The username for the AI
	 */
	public function getUsername()
	{
		$aiTitle = "AI - ";
		switch($level)
		{
			case $this->AI_LEVEL_CASUAL:
				return $aiTitle . "Casual";
				
			case $this->AI_LEVEL_EASY:
				return $aiTitle . "Easy";
				
			case $this->AI_LEVEL_MEDIUM:
				return $aiTitle . "Medium";
				
			case $this->AI_LEVEL_HARD:
				return $aiTitle . "Hard";
				
			case $this->AI_LEVEL_IMPOSSIBLE:
				return $aiTitle . "Impossible";
		}
		//This should be impossible
		return $aiTitle . "Unknown";
	}
	
	/**
	 * Get the next move the AI will make
	 * @param b The board the AI is playing on
	 * @return The location the AI will play next
	 */
	public function getNextMove(Board $b) {
		$l;
		if ($this->level == $this->AI_LEVEL_CASUAL)
		{
			//Get a random move
			$l = $this->randomMove($b); //Just pick a random location. Who cares?
		}
		else if ($this->level == $this->AI_LEVEL_EASY)
		{
			//We look for a winning move, else play randomly
			$l = $this->winningMove($b);
			if ($l == NULL)
			{
				$l = $this->randomMove($b);
			}
		}
		else if ($this->level == $this->AI_LEVEL_MEDIUM)
		{
			//We look for a winning move, else we block if we have a certain threshold, else we play randomly
			$l = $this->winningMove($b);
			if ($l == NULL && rand(0, 1))
			{
				$l = $this->blockOpponent($b);
			}
			else
			{
				$l = $this->randomMove($b);
			}
		}
		else if ($this->level == $this->AI_LEVEL_HARD)
		{
			//We look for a winning move, else we try to block, else we play randomly
			$l = $this->winningMove($b);
			if ($l == NULL)
			{
				$l = $this->blockOpponent($b);
			}
			if ($l == NULL)
			{
				$l = $this->randomMove($b);
			}
		}
		else
		{
			//This would be the impossible AI, which needs to have a lot of thinking done
			//For now, have it play randomly like the AI_LEVEL_CASUAL so things don't break
			//This is just to make it simple so we can have testing done
			$l = $this->getOptimalMove($b);
			
		}
		return $l;
	}
	
	/**
	 * Search the board for a winning move
	 * @param b The board the AI is playing on
	 * @return The move the AI will take to win the game, or NULL if the AI can't win yet.
	 */
	private function winningMove(Board $b)
	{
		$piece;
		//If the current turn is one, it is Xs turn. That means the AI is X
		if ($b->getTurn() == 1)
		{
			$piece = 1;
		}
		else
		{
			$piece = 2;
		}
		$board = $b->getBoard();
		
		//Try every free space on the board for a winning move. This isn't exactly efficient but it's the simplest approach
		for ($x = 0; $x < count($board); $x++)
		{
			for ($y = 0; $y < count($board[$x]); $y++)
			{
				for ($z = 0; $z < count($board[$x][$y]); $z++)
				{
					if ($board[$x][$y][$z] == 0)
					{
						//The space is free, put a piece there and test it
						$board[$x][$y][$z] = $piece;
						if ($b->testBoard($board, $b->getTurn()) == 1)
						{
							//This is a winning move and the AI should take it
							$board[$x][$y][$z] = 0; //Set it back in case
							return array($x, $y, $z);
						}
						$board[$x][$y][$z] = 0; //Set it back just int case
					}
				}
			}
		}
		
		//No winning move available
		return NULL;
	}
	
	/**
	 * Search the board for a move to block the opponent
	 * @param b The board the AI is playing on
	 * @return The move the AI will take to block the opponent, or NULL if there is nothing to block yet
	 */
	private function blockOpponent(Board $b)
	{
		$opponent;
		//If the current turn is 1, it is Xs turn. That means the opponent is O. The converse is true
		if ($b->getTurn() == 1)
		{
			$opponent = 2;
		}
		else
		{
			$opponent = 1;
		}
		$board = $b->getBoard();
		
		//Try every free space on the board for the opponent winning move. This isn't efficient either, but still simplest approach
		for ($x = 0; $x < count($board); $x++)
		{
			for ($y = 0; $y < count($board[$x]); $y++)
			{
				for ($z = 0; $z < count($board[$x][$y]); $z++)
				{
					if ($board[$x][$y][$z] == 0)
					{
						//The space is free, test it
						$board[$x][$y][$z] = $opponent;
						if ($b->testBoard($board, $b->getTurn()) == 1)
						{
							//That move can end the game, so we need to block it
							$board[$x][$y][$z] = 0; //Set it back just in case
							return array($x, $y, $z);
						}
						$board[$x][$y][$z] = 0; //Set it back
					}
				}
			}
		}
		//Nothing to block
		return NULL;
	}
	
	/**
	 * Get a random location on the board to play
	 * @param b The board the AI is playing on
	 * @return A random location on the board that is still free.
	 */
	private function randomMove(Board $b)
	{
		//This is kind of bad due to making a new random object every time, but it should be okay due to a small size
		$list = $b->getAvailableMoves();
		return $list[rand(0, count($list) - 1)];
	}
	
	/**
	 * Get the optimal move that the AI can make. This is used by the impossible AI to ensure it cannot lose.
	 * The function getWeightOfMove will get the highest weighing move.
	 * @param b The board the AI is playing on
	 * @return The optimal location the AI can play.
	 */
	private function getOptimalMove(Board $b)
	{
		$piece;
		//If the current turn is one, it is Xs turn. That means the AI is X
		if ($b->getTurn() == 1)
		{
			$piece = 1;
		}
		else
		{
			$piece = 2;
		}
		$board = $b->getBoard();
		
		//This should never return NULL. Something is wrong if it does
		$bestLocation = NULL;
		$bestWeight = $PHP_INT_MIN;
		for ($x = 0; $x < count($board); $x++)
		{
			for ($y = 0; $y < count($board[$x]); $y++)
			{
				for ($z = 0; $z < count($board[$x][$y]); $z++)
				{
					if ($board[$x][$y][$z] == 0)
					{
						//This is a valid move
						$board[$x][$y][$z] = $piece;
						$weight = $this->getWeightOfMove($board, $b, $b->getTurn() % 2);
						if ($weight > $bestWeight)
						{
							$bestWeight = $weight;
							$bestLocation = array($x, $y, $z);
						}
						$board[$x][$y][$z] = 0;
					}
				}
			}
		}
		return $bestLocation;
	}
	
	/**
	 * Get the weight of a move. If the game is not over yet, the function will recurse until it is.
	 * @param board The board array the AI is playing on
	 * @param b A board object to test the board
	 * @param turn The turn of the board (because the board object won't be accurate)
	 * @return -1 if the opponent wins, 0 if a tie, 1 if the AI wins
	 */
	private function getWeightOfMove(array $board, Board $b, $turn)
	{
		//Note, b.getTurn() will tell us which player the AI is
		//Example, b.getTurn() is 1. AI is player 1. if turn is 0, AI won.
		$result = $b->testBoard($board, $turn + 1);
		if ($result == 0)
		{
			//Game is not over
			$piece;
			$weight = 0;
			if ($turn == 0)
			{
				$piece = 1;
			}
			else
			{
				$piece = 2;
			}
			for ($x = 0; $x < count($board); $x++)
			{
				for ($y = 0; $y < count($board[$x]); $y++)
				{
					for ($z = 0; $z < count($board[$x][$y]); $z++)
					{
						if ($board[$x][$y][$z] == 0)
						{
							//This is a valid move
							$board[$x][$y][$z] = $piece;
							$weight += $this->getWeightOfMove($board, $b, ($turn + 1) % 2);
							$board[$x][$y][$z] = 0;
						}
					}
				}
			}
			return $weight;
		}
		else if ($result == 1 && $turn == $b->getTurn() - 1)
		{
			//Game is over and the AI won
			return 1;
		}
		else if ($result == 1 && $turn != $b->getTurn() - 1)
		{
			//Game is over and the AI lost
			return -1;
		}
		else
		{
			//Game is tied
			return 0;
		}
	}
}
?>