/**
 * @author	Andrew Sytsma <asytsma@purdue.edu>
 */
public interface Player
{
	/**
	 * Returns the username of the player.
	 * 
	 * @return	Returns the username of the player.
	 */
	public String getUsername();
	
	/**
	 * Adds 1 to the current player's wins
	 * and updates the database.
	 */
	public void incrementWins();
	
	/**
	 * Adds 1 to the current player's losses
	 * and updates the database.
	 */
	public void incrementLosses();
	
	/**
	 * Adds 1 to the current player's ties
	 * and updates the database.
	 */
	public void incrementTies();
}	//end of Player interface
