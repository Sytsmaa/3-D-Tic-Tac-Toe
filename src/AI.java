import java.util.Random;
import java.util.ArrayList;

public class AI implements Player {
	
	/**
	* The simplest AI level. This AI just plays randomly and won't even attempt to win.
	* It's like playing a two year old.
	*/
	public static final int AI_LEVEL_CASUAL = 0;
	
	/**
	* The simple AI level. This AI just plays randomly, and will
	* only attempt to win if it manages to have all but one piece
	* in a line.
	*/
	public static final int AI_LEVEL_EASY = 1;
	
	/**
	* This AI level will most of the time block the player, but
	* will sometimes suffer from tunnel vision and miss a block.
	*/
	public static final int AI_LEVEL_MEDIUM = 2;
	
	/**
	* This AI level will always block the player if the player is about
	* to win. Therefore, the player has to have multiple ways of winning
	* to beat the AI.
	*/
	public static final int AI_LEVEL_HARD = 3;
	
	/**
	* The hardest AI level. This AI cannot be beaten, only tied with.
	*/
	public static final int AI_LEVEL_IMPOSSIBLE = 4;
	
	//Private fields about the AI
	private int level;
	private Piece piece;
	
	/**
	 * The default constructor for an AI. Assumes medium difficulty
	 */
	public AI() {
		//We'll assume medium is the default, just in case.
		this(AI_LEVEL_MEDIUM);
	}
	
	/**
	 * Constructor for the AI
	 * @param level The level the AI will be. These are statically defined in the AI class
	 */
	public AI(int level) {
		//This is to make sure a valid level is passed
		switch(level) {
			case AI_LEVEL_CASUAL:
				this.level = AI_LEVEL_CASUAL;
			case AI_LEVEL_EASY:
				this.level = AI_LEVEL_EASY;
			case AI_LEVEL_MEDIUM:
				this.level = AI_LEVEL_MEDIUM;
			case AI_LEVEL_HARD:
				this.level = AI_LEVEL_HARD;
			case AI_LEVEL_IMPOSSIBLE:
			default:
				this.level = AI_LEVEL_IMPOSSIBLE;
		}
	}
	
	/**
	 * Get the username for the AI.
	 * @return The username for the AI
	 */
	public String getUsername() {
		String aiTitle = "AI - ";
		switch(level) {
			case AI_LEVEL_CASUAL:
				return aiTitle + "Casual";
			case AI_LEVEL_EASY:
				return aiTitle + "Easy";
			case AI_LEVEL_MEDIUM:
				return aiTitle + "Medium";
			case AI_LEVEL_HARD:
				return aiTitle + "Hard";
			case AI_LEVEL_IMPOSSIBLE:
				return aiTitle + "Impossible";
		}
		//This should be impossible
		return aiTitle + "Unknown";
	}
	
	/**
	 * Get the next move the AI will make
	 * @param b The board the AI is playing on
	 * @return The location the AI will play next
	 */
	public Location getNextMove(Board b) {
		Location l;
		if (level == AI_LEVEL_CASUAL) {
			//Get a random move
			l = randomMove(b); //Just pick a random location. Who cares?
		}
		else if (level == AI_LEVEL_EASY) {
			//We look for a winning move, else play randomly
			l = winningMove(b);
			if (l == null) l = randomMove(b);
		}
		else if (level == AI_LEVEL_MEDIUM) {
			//We look for a winning move, else we block if we have a certain threshold, else we play randomly
			l = winningMove(b);
			if (l == null && Math.random() <= .5) l = blockOpponent(b);
			else l = randomMove(b);
		}
		else if (level == AI_LEVEL_HARD) {
			//We look for a winning move, else we try to block, else we play randomly
			l = winningMove(b);
			if (l == null) l = blockOpponent(b);
			if (l == null) l = randomMove(b);
		}
		else {
			//This would be the impossible AI, which needs to have a lot of thinking done
			//For now, have it play randomly like the AI_LEVEL_CASUAL so things don't break
			//This is just to make it simple so we can have testing done
			l = getOptimalMove(b);
			
		}
		return l;
	}
	
	/**
	 * Search the board for a winning move
	 * @param b The board the AI is playing on
	 * @return The move the AI will take to win the game, or null if the AI can't win yet.
	 */
	private Location winningMove(Board b) {
		Piece piece;
		//If the current turn is one, it is Xs turn. That means the AI is X
		if (b.getTurn() == 1) piece = new X(new Location(0,0,0));
		else piece = new O(new Location(0,0,0));
		Piece[][][] board = b.getBoard();
		
		//Try every free space on the board for a winning move. This isn't exactly efficient but it's the simplest approach
		for (int x = 0; x < board.length; x++) {
			for (int y = 0; y < board[x].length; y++) {
				for (int z = 0; z < board[x][y].length; z++) {
					if (board[x][y][z] == null) {
						//The space is free, put a piece there and test it
						board[x][y][z] = piece;
						if (b.testBoard(board, b.getTurn()) == 1) {
							//This is a winning move and the AI should take it
							board[x][y][z] = null; //Set it back in case
							return new Location(x, y, z);
						}
						board[x][y][z] = null; //Set it back just int case
					}
				}
			}
		}
		
		//No winning move available
		return null;
	}
	
	/**
	 * Search the board for a move to block the opponent
	 * @param b The board the AI is playing on
	 * @return The move the AI will take to block the opponent, or null if there is nothing to block yet
	 */
	private Location blockOpponent(Board b) {
		Piece opponent;
		//If the current turn is 1, it is Xs turn. That means the opponent is O. The converse is true
		if (b.getTurn() == 1) opponent = new O(new Location(0,0,0));
		else opponent = new X(new Location(0,0,0));
		Piece[][][] board = b.getBoard();
		
		//Try every free space on the board for the opponent winning move. This isn't efficient either, but still simplest approach
		for (int x = 0; x < board.length; x++) {
			for (int y = 0; y < board[x].length; y++) {
				for (int z = 0; z < board[x][y].length; z++) {
					if (board[x][y][z] == null) {
						//The space is free, test it
						board[x][y][z] = opponent;
						if (b.testBoard(board, b.getTurn()) == 1) {
							//That move can end the game, so we need to block it
							board[x][y][z] = null; //Set it back just in case
							return new Location(x, y, z);
						}
						board[x][y][z] = null; //Set it back
					}
				}
			}
		}
		//Nothing to block
		return null;
	}
	
	/**
	 * Get a random location on the board to play
	 * @param b The board the AI is playing on
	 * @return A random location on the board that is still free.
	 */
	private Location randomMove(Board b) {
		//This is kind of bad due to making a new random object every time, but it should be okay due to a small size
		return b.getAvailableMoves().get(new Random().nextInt(b.getAvailableMoves().size()));
	}
	
	/**
	 * Get the optimal move that the AI can make. This is used by the impossible AI to ensure it cannot lose.
	 * The function getWeightOfMove will get the highest weighing move.
	 * @param b The board the AI is playing on
	 * @return The optimal location the AI can play.
	 */
	private Location getOptimalMove(Board b) {
		Piece piece;
		//If the current turn is one, it is Xs turn. That means the AI is X
		if (b.getTurn() == 1) piece = new X(new Location(0,0,0));
		else piece = new O(new Location(0,0,0));
		Piece[][][] board = b.getBoard();
		
		//This should never return null. Something is wrong if it does
		Location bestLocation = null;
		int bestWeight = Integer.MIN_VALUE;
		for (int x = 0; x < board.length; x++) {
			for (int y = 0; y < board[x].length; y++) {
				for (int z = 0; z < board[x][y].length; z++) {
					if (board[x][y][z] == null) {
						//This is a valid move
						board[x][y][z] = piece;
						int weight = getWeightOfMove(board, b, b.getTurn() % 2);
						if (weight > bestWeight) {
							bestWeight = weight;
							bestLocation = new Location(x, y, z);
						}
						board[x][y][z] = null;
					}
				}
			}
		}
		return bestLocation;
	}
	
	/**
	 * Get the weight of a move. If the game is not over yet, the function will recurse until it is.
	 * @param board The board array the AI is playing on
	 * @param b A board object to test the board
	 * @param turn The turn of the board (because the board object won't be accurate)
	 * @return -1 if the opponent wins, 0 if a tie, 1 if the AI wins
	 */
	private int getWeightOfMove(Piece[][][] board, Board b, int turn) {
		//Note, b.getTurn() will tell us which player the AI is
		//Example, b.getTurn() is 1. AI is player 1. if turn is 0, AI won.
		int result = b.testBoard(board, turn + 1);
		if (result == 0) {
			//Game is not over
			Piece piece;
			int weight = 0;
			if (turn == 0) piece = new X(new Location(0,0,0));
			else piece = new O(new Location(0,0,0));
			for (int x = 0; x < board.length; x++) {
				for (int y = 0; y < board[x].length; y++) {
					for (int z = 0; z < board[x][y].length; z++) {
						if (board[x][y][z] == null) {
							//This is a valid move
							board[x][y][z] = piece;
							weight += getWeightOfMove(board, b, (turn + 1) % 2);
							board[x][y][z] = null;
						}
					}
				}
			}
			return weight;
		}
		else if (result == 1 && turn == b.getTurn() - 1) {
			//Game is over and the AI won
			return 1;
		}
		else if (result == 1 && turn != b.getTurn() - 1) {
			//Game is over and the AI lost
			return -1;
		}
		else {
			//Game is tied
			return 0;
		}
	}
}
