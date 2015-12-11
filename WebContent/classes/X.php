<?php
require_once($homeDir . "classes/Piece.php");

/**
 * @author	Andrew Sytsma <asytsma@purdue.edu>
 */
class X implements Piece
{
	/**
	 * Holds the picture of the X.
	 */
	private $picture;
	
	/**
	 * Holds the location of the X.
	 */
	private $location;
	
	/**
	 * X constructor initializes fields.
	 * 
	 * @param location	The location of the X.
	 */
	public function __construct($location)
	{
		$this->picture = NULL;	//TODO:  Remove this
		//TODO:  this.picture = picture of an X;
		$this->location = $location;
	}	//end of X constructor
	
	/**
	 * Returns the picture of the X.
	 * 
	 * @return	Returns the picture of the X.
	 */
	public function getPicture()
	{
		return $this->picture;
	}	//end of getPicture method
	
	/**
	 * Returns the location of the X.
	 * 
	 * @return	Returns the location of the X.
	 */
	public function getLocation()
	{
		return $this->location;
	}	//end of getLocation method
}	//end of X class
?>