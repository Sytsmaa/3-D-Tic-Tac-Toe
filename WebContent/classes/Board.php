<?php
	require_once($homeDir . "classes/Location.php");
	
	class Board
	{
		private $IN_PROGRESS = 0;
		private $GAME_OVER = 1;
		private $TIE = 2;
		private $X_PIECE = 1;
		private $O_PIECE = 2;
		private $EMPTY_SPACE = 0;
		private $turn;
		private $board;
		private $player1;
		private $player2;
		private $availableMoves;
		private $state;
		
		
		public function __construct(Player $p1, Player $p2)
		{
			$this->turn = 1;
			$this->board = array
			(
				array
				(
					array(0, 0, 0, 0),
					array(0, 0, 0, 0),
					array(0, 0, 0, 0),
					array(0, 0, 0, 0)
				),
				array
				(
					array(0, 0, 0, 0),
					array(0, 0, 0, 0),
					array(0, 0, 0, 0),
					array(0, 0, 0, 0)
				),
				array
				(
					array(0, 0, 0, 0),
					array(0, 0, 0, 0),
					array(0, 0, 0, 0),
					array(0, 0, 0, 0)
				),
				array
				(
					array(0, 0, 0, 0),
					array(0, 0, 0, 0),
					array(0, 0, 0, 0),
					array(0, 0, 0, 0)
				)
			);
			$this->player1 = $p1;
			$this->player2 = $p2;
			$this->availableMoves = array();
			
			for ($x = 0; $x < 4; $x++)
			{
				for ($y = 0; $y < 4; $y++)
				{
					for ($z = 0; $z < 4; $z++)
					{
						$this->availableMoves[] = array($x, $y, $z);
					}	//end for
				}	//end for
			}	//end for
			
			$this->state = $this->IN_PROGRESS;
		}	//end of Board constructor
		
		private function isTaken($xLoc, $yLoc, $zLoc)
		{			
			if ($this->board[$xLoc][$yLoc][$zLoc] === $this->EMPTY_SPACE)
			{
				return false;
			}	//end if
			
			return true;
		}	//end of isTaken method
		
		public function getCurrentPlayer()
		{
			if ($this->turn === 1)
			{
				return $this->player1;
			}	//end if
			
			return $this->player2;
		}	//end of getCurrentPlayer method
		
		public function getTurn()
		{
			return $this->turn;
		}	//end of getTurn method
		
		public function makeMove($coordinate)
		{
			$xLoc = $coordinate[0];
			$yLoc = $coordinate[1];
			$zLoc = $coordinate[2];
			if ($this->state != $this->IN_PROGRESS)
			{
				return;
			}	//end if
			
			if ($this->isTaken($xLoc, $yLoc, $zLoc))
			{
				return;
			}	//end if
			
			$piece = $this->O_PIECE;
			
			if ($this->turn === 1)
			{
				$piece = $this->X_PIECE;
			}	//end if
			
			$this->board[$xLoc][$yLoc][$zLoc] = $piece;
			
			for($x = 0; $x < count($this->availableMoves); $x++)
			{
				$c = $this->availableMoves[$x];
				if($c[0] === $xLoc && $c[1] === $yLoc && $c[2] === $zLoc)
				{
					unset($this->availableMoves[$x]);
					$this->availableMoves = array_values($this->availableMoves);
					break;
				}
			}
			
			$result = $this->isGameOver($piece);
			
			if ($result === $this->IN_PROGRESS)
			{
				if ($this->turn === 1)
				{
					$this->turn = 2;
				}
				else
				{
					$this->turn = 1;
				}	//end if
			}
			else
			{
				$this->state = $result;
			}	//end if
		}	//end of makeMove method
		
		public function getState()
		{
			return $this->state;
		}	//end of getState method
		
		private function isGameOver($piece)
		{
			/*if ($this->check2DRows($piece))
			{
				return $this->GAME_OVER;
			}	//end if
			
			if ($this->check2DColumns($piece))
			{
				return $this->GAME_OVER;
			}	//end if
			
			if ($this->check2DDiagonals($piece))
			{
				return $this->GAME_OVER;
			}	//end if
			
			if ($this->check3DRows($piece))
			{
				return $this->GAME_OVER;
			}	//end if
			
			if ($this->check3DDiagonals($piece))
			{
				return $this->GAME_OVER;
			}	//end if */
			
			if($this->checkBoard($piece))
			{
				return $this->GAME_OVER;
			}
			
			if ($this->isTie())
			{
				return $this->TIE;
			}	//end if
			
			return $this->IN_PROGRESS;
		}	//end of isGameOver method
		
		private function isTie()
		{
			
			/*for ($x = 0; $x < 4; $x++)
			{
				for ($y = 0; $y < 4; $y++)
				{
					for ($z = 0; $z < 4; $z++)
					{
						if ($this->board[$x][$y][$z] === $this->EMPTY_SPACE)
						{
							return false;
						}	//end if
					}	//end for
				}	//end for
			}	//end for*/
			
			
			if(count($this->availableMoves) === 0)
			{
				return true;
			}
			return false;
			
			//return true;
		}	//end of isTie method
		
		private function check2DBoard($board, $piece)
		{
			$found = true;
			
			//search all columns
			for($x = 0; $x < 4; $x++)
			{
				$found = true;
				
				//search all rows in column
				for($y = 0; $y < 4; $y++)
				{
					//not continuous
					if($board[$x][$y] !== $piece)
					{
						$found = false;
						break;
					}
				}
				
				//we found one
				if($found)
				{
					return true;
				}
			}
			
			//search all rows
			for($y = 0; $y < 4; $y++)
			{
				$found = true;
				
				//search all columns in row
				for($x = 0; $x < 4; $x++)
				{
					//not continuous
					if($board[$x][$y] !== $piece)
					{
						$found = false;
						break;
					}
				}
				
				//we found one
				if($found)
				{
					return true;
				}
			}
			
			//check top left to bottom right
			$found = true;
			for($x = 0; $x < 4; $x++)
			{
				//not continuous
				if($board[$x][$x] !== $piece)
				{
					$found = false;
					break;
				}
			}
			
			//we found one
			if($found)
			{
				return true;
			}
			
			//check bottom left to top right
			$found = true;
			for($x = 0; $x < 4; $x++)
			{
				//not continuous
				if($board[$x][3 - $x] !== $piece)
				{
					$found = false;
					break;
				}
			}
			
			return $found;
		}
		
		private function checkBoard($piece)
		{
			$board2D = array
			(
				array(0, 0, 0, 0),
				array(0, 0, 0, 0),
				array(0, 0, 0, 0),
				array(0, 0, 0, 0)
			);
			
			//search 2D top to bottom
			for($z = 0; $z < 4; $z++)
			{
				//get 2D board
				for($y = 0; $y < 4; $y++)
				{
					for($x = 0; $x < 4; $x++)
					{
						$board2D[$x][$y] = $this->board[$x][$y][$z];
					}
				}
				
				//this board has a connection
				if($this->check2DBoard($board2D, $piece))
				{
					return true;
				}
			}
			
			//search 2D left to right
			for($x = 0; $x < 4; $x++)
			{
				//get 2D board
				for($z = 0; $z < 4; $z++)
				{
					for($y = 0; $y < 4; $y++)
					{
						$board2D[$y][$z] = $this->board[$x][$y][$z];
					}
				}
				
				//this board has a connection
				if($this->check2DBoard($board2D, $piece))
				{
					return true;
				}
			}
			
			//search 2D back to front
			for($y = 0; $y < 4; $y++)
			{
				//get 2D board
				for($z = 0; $z < 4; $z++)
				{
					for($x = 0; $x < 4; $x++)
					{
						$board2D[$x][$z] = $this->board[$x][$y][$z];
					}
				}
				
				//this board has a connection
				if($this->check2DBoard($board2D, $piece))
				{
					return true;
				}
			}
			
			//4 diagonals
			//top left back to bottom right front
			$found = true;
			for($x = 0; $x < 4; $x++)
			{
				//not continuous
				if($this->board[$x][$x][$x] !== $piece)
				{
					$found = false;
					break;
				}
			}
			
			//we found one
			if($found)
			{
				return true;
			}
			
			//bottom left back to top right front
			$found = true;
			for($x = 0; $x < 4; $x++)
			{
				//not continuous
				if($this->board[$x][$x][3 - $x] !== $piece)
				{
					$found = false;
					break;
				}
			}
			
			//we found one
			if($found)
			{
				return true;
			}
			
			//top left front to bottom right back
			$found = true;
			for($x = 0; $x < 4; $x++)
			{
				//not continuous
				if($this->board[$x][3 - $x][$x] !== $piece)
				{
					$found = false;
					break;
				}
			}
			
			//we found one
			if($found)
			{
				return true;
			}
			
			//bottom left front to top right back
			$found = true;
			for($x = 0; $x < 4; $x++)
			{
				//not continuous
				if($this->board[$x][3 - $x][3 - $x] !== $piece)
				{
					$found = false;
					break;
				}
			}
			
			return $found;
		}
		
		private function check2DRows($piece)
		{
			for ($z = 0; $z < 4; $z++)
			{
				for ($y = 0; $y < 4; $y++)
				{
					$found = true;
					
					for ($x = 0; $x < 4; $x++)
					{
						if ($piece !== $this->board[$x][$y][$z])
						{
							$found = false;
							break;
						}	//end if
					}	//end for
					
					if ($found)
					{
						return true;
					}	//end if
				}	//end for
			}	//end for
			
			return false;
		}	//end of checkRows method
		
		private function check2DColumns($piece)
		{
			for ($z = 0; $z < 4; $z++)
			{
				for ($x = 0; $x < 4; $x++)
				{
					$found = true;
					
					for ($y = 0; $y < 4; $y++)
					{
						if ($piece !== $this->board[$x][$y][$z])
						{
							$found = false;
							break;
						}	//end if
					}	//end for
					
					if ($found)
					{
						return true;
					}	//end if
				}	//end for
			}	//end for
			
			return false;
		}	//end of check2DColumns method
		
		private function check2DDiagonals($piece)
		{
			for ($z = 0; $z < 4; $z++)
			{
				$found = true;
				
				if ($piece === $this->board[0][0][$z])
				{
					for ($num = 1; $num < 4; $num++)
					{
						if ($piece !== $this->board[$num][$num][$z])
						{
							$found = false;
							break;
						}	//end if
					}	//end for
				}
				else if ($piece === $this->board[3][0][$z])
				{
					for ($num = 1; $num < 4; $num++)
					{
						if ($piece !== $this->board[3 - $num][$num][$z])
						{
							$found = false;
							break;
						}	//end if
					}	//end for
				}
				else
				{
					$found = false;
				}	//end if
				
				if ($found)
				{
					return true;
				}
			}	//end for
			
			return false;
		}	//end of check2DDiagonals method
		
		private function check3DRows($piece)
		{
			for ($x = 0; $x < 4; $x++)
			{
				for ($y = 0; $y < 4; $y++)
				{
					$found = true;
					
					for ($z = 0; $z < 4; $z++)
					{
						if ($piece !== $this->board[$x][$y][$z])
						{
							$found = false;
							break;
						}	//end if
					}	//end for
					
					if ($found)
					{
						return true;
					}	//end if
				}	//end for
			}	//end for
			
			return false;
		}	//end of check3DRows method
		
		private function check3DDiagonals($piece)
		{
			if ($piece === $this->board[0][0][0])
			{
				for ($num = 1; $num < 4; $num++)
				{
					if ($piece !== $this->board[$num][$num][$num])
					{
						return false;
					}	//end if
				}	//end for
			}
			else if ($piece === $this->board[3][0][0])
			{
				for ($num = 1; $num < 4; $num++)
				{
					if ($piece !== $this->board[3 - $num][$num][$num])
					{
						return false;
					}	//end if
				}	//end for
			}
			else if ($piece === $this->board[0][3][0])
			{
				for ($num = 1; $num < 4; $num++)
				{
					if ($piece !== $this->board[$num][3 - $num][$num])
					{
						return false;
					}	//end if
				}	//end for
			}
			else if ($piece === $this->board[3][3][0])
			{
				for ($num = 1; $num < 4; $num++)
				{
					if ($piece !== $this->board[3 - $num][3 - $num][$num])
					{
						return false;
					}	//end if
				}	//end for
			}
			else
			{
				return false;
			}	//end if
			
			return true;
		}	//end of check3DDiagonals method
		
		public function getAvailableMoves()
		{
			return $this->availableMoves;
		}	//end of getAvailableMoves method
		
		public function getBoard()
		{
			return $this->board;
		}	//end of getBoard method
		
		public function testBoard($testBoard, $t)
		{
			$oldBoard = $this->board;
			$this->board = $testBoard;
			$result;
			
			if ($t == 1)
			{
				$result = $this->isGameOver($this->X_PIECE);
			}
			else
			{
				$result = $this->isGameOver($this->O_PIECE);
			}	//end if
			
			$this->board = $oldBoard;
			
			return $result;
		}	//end of testBoard method
	}	//end of Board class
?>