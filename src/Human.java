/**
 * @author	Andrew Sytsma <asytsma@purdue.edu>
 */
public class Human implements Player
{	
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
}	//end of Human class
