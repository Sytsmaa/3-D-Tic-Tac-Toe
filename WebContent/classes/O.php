<?php
require_once($homeDir . "classes/Piece.php");

/**
 * @author	Andrew Sytsma <asytsma@purdue.edu>
 */
class O implements Piece
{
	/**
	 * Holds the picture of the O.
	 */
	private $picture;
	
	/**
	 * Holds the location of the O.
	 */
	private $location;
	
	/**
	 * X constructor initializes fields.
	 * 
	 * @param location	The location of the O.
	 */
	public function __construct($location)
	{
		$this->picture = NULL;	//TODO:  Remove this
		//TODO:  this.picture = picture of an O;
		$this->location = $location;
	}	//end of O constructor
	
	/**
	 * Returns the picture of the O.
	 * 
	 * @return	Returns the picture of the O.
	 */
	public function getPicture()
	{
		return $this->picture;
	}	//end of getPicture method
	
	/**
	 * Returns the location of the O.
	 * 
	 * @return	Returns the location of the O.
	 */
	public function getLocation()
	{
		return $this->location;
	}	//end of getLocation method
}	//end of X class
?>