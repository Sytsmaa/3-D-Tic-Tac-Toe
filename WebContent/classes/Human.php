<?php
require_once($homeDir . "classes/Player.php");

/**
 * @author	Andrew Sytsma <asytsma@purdue.edu>
 */
class Human implements Player
{	
	/**
	 * Holds the player's username.
	 */
	private final $username;
	
	/**
	 * Human constructor initializes fields.
	 * 
	 * @param username	The player's username.
	 */
	public function __construct($username)
	{
		$this->username = $username;
	}	//end of Human constructor
	
	/**
	 * Returns the username of the player.
	 * 
	 * @return	Returns the username of the player.
	 */
	public function getUsername()
	{
		return $this->username;
	}	//end of getUsername method
}	//end of Human class
?>