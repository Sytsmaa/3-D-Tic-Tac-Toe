/**
 * @author	Andrew Sytsma <asytsma@purdue.edu>
 */
public class Human implements Player
{
	/**
	 * Holds the number of wins the player has.
	 */
	private int wins;
	
	/**
	 * Holds the number of losses the player has.
	 */
	private int losses;
	
	/**
	 * Holds the number of ties the player has.
	 */
	private int ties;
	
	/**
	 * Holds the player's username.
	 */
	private final String username;
	
	/**
	 * Human constructor initializes fields.
	 * 
	 * @param username	The player's username.
	 */
	public Human(String username)
	{
		//TODO:  this.wins = get wins from database;
		//TODO:  this.losses = get losses from database;
		//TODO:  this.ties = get ties from database;
		this.username = username;
	}	//end of Human constructor
	
	/**
	 * Returns the username of the player.
	 * 
	 * @return	Returns the username of the player.
	 */
	public String getUsername()
	{
		return this.username;
	}	//end of getUsername method
	
	/**
	 * Adds 1 to the current player's wins
	 * and updates the database.
	 */
	public void incrementWins()
	{
		this.wins += 1;
		//TODO:  update database
	}	//end of incrementWins method
	
	/**
	 * Adds 1 to the current player's losses
	 * and updates the database.
	 */
	public void incrementLosses()
	{
		this.losses += 1;
		//TODO:  update database
	}	//end of incrementLosses method
	
	/**
	 * Adds 1 to the current player's ties
	 * and updates the database.
	 */
	public void incrementTies()
	{
		this.ties += 1;
		//TODO:  update database
	}	//end of incrementTies method
}	//end of Human class
