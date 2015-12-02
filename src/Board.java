
/**
 * @author	Andrew Sytsma <asytsma@purdue.edu>
 */
public class Board
{
	/**
	 * Holds the current player's turn.
	 */
	private int turn;
	
	/**
	 * Holds a reference to the board.
	 */
	private Piece[][][] board;
	
	/**
	 * Holds a reference to the first player.
	 */
	private Player player1;
	
	/**
	 * Holds a reference to the second player.
	 */
	private Player player2;
	
	/**
	 * Board constructor initializes fields
	 * 
	 * @param player1	Holds a reference to the first player.
	 * @param player2	Holds a reference to the second player.
	 */
	public Board(Player player1, Player player2)
	{
		this.turn = 1;
		this.board = new Piece[4][4][4];
		this.player1 = player1;
		this.player2 = player2;
	}	//end of Board constructor
	
	/**
	 * Returns whether or not the location is taken.
	 * True  = Taken
	 * False = Not Taken
	 * 
	 * @param location	Holds the location to be checked.
	 * @return			Returns whether or not the location is taken.
	 */
	private boolean isTaken(Location location)
	{
		//check if the location is taken
		if (this.board[location.getX()][location.getY()][location.getZ()] == null)	//the location is not taken
		{
			return false;
		}	//end if
		
		return true;
	}	//end of isValid method
	
	/**
	 * Returns a reference to the current player.
	 * 
	 * @return	Returns a reference to the current player.
	 */
	public Player getCurrentPlayer()
	{
		//check what player's turn it is
		if (this.turn == 1)	//player1's turn
		{
			return this.player1;
		}
		else	//player2's turn
		{
			return this.player2;
		}	//end if
	}	//end of getCurrentPlayer method
	
	/**
	 * Returns the turn number.
	 * 1 = Player1
	 * 2 = Player2
	 * 
	 * @return	Returns the turn number.
	 */
	public int getTurn()
	{
		return this.turn;
	}	//end getTurn method
	
	/**
	 * Makes a player's move.
	 * 
	 * @param location	Holds the location of the move.
	 */
	public void makeMove(Location location)
	{
		//check if the location is taken
		if (isTaken(location))
		{
			return;
		}	//end if
		
		Piece piece;	//holds the piece to be played
		
		//check what player's turn it is
		if (this.turn == 1)	//player1's turn
		{
			piece = new X(location);
		}
		else	//player2's turn
		{
			piece = new O(location);
		}	//end if
		
		//put the piece on the board
		this.board[location.getX()][location.getY()][location.getZ()] = piece;
		//TODO:  Put piece on screen
		
		int state = isGameOver(piece.getClass());	//holds the state of the game
		
		//check if the game is over
		if (state == 1)	//game is over
		{
			//update the players' statistics
			//check which player's turn it is
			if (this.turn == 1)	//player1's turn
			{
				this.player1.incrementWins();
				this.player2.incrementLosses();
			}
			else	//player2's turn
			{
				this.player2.incrementWins();
				this.player1.incrementLosses();
			}	//end if
			
			//TODO:  Display winner
		}
		else if (state == 2)	//game is tied
		{
			//update the players' statistics
			this.player1.incrementTies();
			this.player2.incrementTies();
			
			//TODO:  Display tie
		}
		else	//game is not over
		{
			//swap the turns
			if (this.turn == 1)	//it was player1's turn
			{
				this.turn = 2;
			}
			else	//it was player2's turn
			{
				this.turn = 1;
			}	//end if
		}	//end if
	}	//end of makeMove method
	
	/**
	 * Returns a number representing the state of the game.
	 * 0 = Not Game Over
	 * 1 = Game Over
	 * 2 = Tie
	 * 
	 * @return	Returns a number representing the state of the game.
	 */
	private int isGameOver(Class piece)
	{
		//check the 2D rows
		if (check2DRows(piece))	//a win was found
		{
			return 1;
		}	//end if
		
		//check the 2D columns
		if (check2DColumns(piece))	//a win was found
		{
			return 1;
		}	//end if
		
		//check the 2D diagonals
		if (check2DDiagonals(piece))	//a win was found
		{
			return 1;
		}	//end if
		
		//check the 3D rows
		if (check3DRows(piece))	//a win was found
		{
			return 1;
		}	//end if
		
		//check the 3D diagonals
		if (check3DDiagonals(piece))	//a win was found
		{
			return 1;
		}	//end if
		
		//check for a tie
		if (isTie())	//a tie was found
		{
			return 2;
		}	//end if
	
		return 0;
	}	//end of isGameOver method
	
	/**
	 * Returns whether or not there is a tie.
	 * True  = Tie
	 * False = No Tie 
	 * 
	 * @return	Returns whether or not there is a tie.
	 */
	private boolean isTie()
	{
		//loop through the board to see if all the spaces are filled
		for (int x = 0; x < 4; x += 1)
		{
			for (int y = 0; y < 4; y += 1)
			{
				for (int z = 0; z < 4; z += 1)
				{
					//check if the space is empty
					if (this.board[x][y][z] == null)	//the space is empty
					{
						return false;
					}	//end if
				}	//end for
			}	//end for
		}	//end for
		
		return true;
	}	//end isTie method
	
	/**
	 * Returns whether or not there is a win in the 2D rows.
	 * True  = Win
	 * False = No Win
	 * 
	 * @return	Returns whether or not there is a win in the 2D rows.
	 */
	private boolean check2DRows(Class piece)
	{
		//loop through the 2D rows
		for (int z = 0; z < 4; z += 1)
		{
			for (int y = 0; y < 4; y += 1)
			{
				boolean found = true;	//holds if a win was found
				
				for (int x = 0; x < 4; x += 1)
				{
					//check the piece
					if (!piece.isInstance(this.board[x][y][z]))	//bad piece
					{
						found = false;
						break;
					}	//end if
				}	//end for
				
				//check if a win was found
				if (found)	//a win was found
				{
					return true;
				}	//end if
			}	//end for
		}	//end for
		
		return false;
	}	//end of checkRows method
	
	/**
	 * Returns whether or not there is a win in the 2D columns.
	 * True  = Win
	 * False = No Win
	 * 
	 * @return	Returns whether or not there is a win in the 2D columns.
	 */
	private boolean check2DColumns(Class piece)
	{
		//loop through the 2D columns
		for (int z = 0; z < 4; z += 1)
		{
			for (int x = 0; x < 4; x += 1)
			{
				boolean found = true;	//holds if a win was found
				
				for (int y = 0; y < 4; y += 1)
				{
					//check the piece
					if (!piece.isInstance(this.board[x][y][z]))	//bad piece
					{
						found = false;
						break;
					}	//end if
				}	//end for
				
				//check if a win was found
				if (found)	//a win was found
				{
					return true;
				}
			}	//end for
		}	//end for
		
		return false;
	}	//end of check2DColumns method
	
	/**
	 * Returns whether or not there is a win in the 2D diagonals.
	 * True  = Win
	 * False = No Win
	 * 
	 * @return	Returns whether or not there is a win in the 2D diagonals.
	 */
	private boolean check2DDiagonals(Class piece)
	{
		//loop through the 2D diagonals
		for (int z = 0; z < 4; z += 1)
		{
			boolean found = true;	//holds if a win was found
			
			//check the 2D diagonals
			if (piece.isInstance(this.board[0][0][z]))	//left diagonal
			{
				for (int num = 1; num < 4; num += 1)
				{
					//check a piece
					if (!piece.isInstance(this.board[num][num][z]))	//bad piece
					{
						found = false;
						break;
					}	//end if
				}	//end for
			}
			else if (piece.isInstance(this.board[3][0][z]))	//right diagonal
			{
				for (int num = 1; num < 4; num += 1)
				{
					//check a piece
					if (!piece.isInstance(this.board[3 - num][num][z]))	//bad piece
					{
						found = false;
						break;
					}	//end if
				}	//end for
			}
			else	//no diagonal
			{
				found = false;
			}	//end if
			
			//check if a win was found
			if (found)	//a win was found
			{
				return true;
			}
		}	//end for
		
		return false;
	}	//end of check2DDiagonals method
	
	/**
	 * Returns whether or not there is a win in the 3D rows.
	 * True  = Win
	 * False = No Win
	 * 
	 * @return	Returns whether or not there is a win in the 3D rows.
	 */
	private boolean check3DRows(Class piece)
	{
		//loop through the 3D rows
		for (int x = 0; x < 4; x += 1)
		{
			for (int y = 0; y < 4; y += 1)
			{
				boolean found = true;	//holds if a win was found
				
				for (int z = 0; z < 4; z += 1)
				{
					//check a piece
					if (!piece.isInstance(this.board[x][y][z]))	//bad piece
					{
						found = false;
						break;
					}	//end if
				}	//end for
				
				//check if a win was found
				if (found)	//a win was found
				{
					return true;
				}	//end if
			}	//end for
		}	//end for
		
		return false;
	}	//end of check3DRows method
	
	/**
	 * Returns whether or not there is a win in the 3D diagonals.
	 * True  = Win
	 * False = No Win
	 * 
	 * @return	Returns whether or not there is a win in the 3D diagonals.
	 */
	private boolean check3DDiagonals(Class piece)
	{
		//check the 3D diagonals
		if (piece.isInstance(this.board[0][0][0]))	//top-left diagonal
		{
			for (int num = 1; num < 4; num += 1)
			{
				//check a piece
				if (!piece.isInstance(this.board[num][num][num]))	//bad piece
				{
					return false;
				}	//end if
			}	//end for
		}
		else if (piece.isInstance(this.board[3][0][0]))	//top-right diagonal
		{
			for (int num = 1; num < 4; num += 1)
			{
				//check a piece
				if (!piece.isInstance(this.board[3 - num][num][num]))	//bad piece
				{
					return false;
				}	//end if
			}	//end for
		}
		else if (piece.isInstance(this.board[0][3][0]))	//bottom-left diagonal
		{
			for (int num = 1; num < 4; num += 1)
			{
				//check a piece
				if (!piece.isInstance(this.board[num][3 - num][num]))	//bad piece
				{
					return false;
				}	//end if
			}	//end for
		}
		else if (piece.isInstance(this.board[3][3][0]))	//bottom-right diagonal
		{
			for (int num = 1; num < 4; num += 1)
			{
				//check a piece
				if (!piece.isInstance(this.board[3 - num][3 - num][num]))	//bad piece
				{
					return false;
				}	//end if
			}	//end for
		}
		else	//no diagonal
		{
			return false;
		}	//end if
		
		return true;
	}	//end of check3DDiagonals method
}	//end of Board class
