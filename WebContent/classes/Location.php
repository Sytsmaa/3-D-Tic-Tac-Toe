<?php
/**
 * @author	Andrew Sytsma <asytsma@purdue.edu>
 */
class Location
{
	/**
	 * Holds the x coordinate of the location.
	 */
	private $x;
	
	/**
	 * Holds the y coordinate of the location.
	 */
	private $y;
	
	/**
	 * Holds the z coordinate of the location.
	 */
	private $z;
	
	/**
	 * Location constructor initializes fields.
	 * 
	 * @param x						The x coordinate of the location
	 * @param y						The y coordinate of the location
	 * @param z						The z coordinate of the location
	 * @throws LocationException	Throws an exception if the coordinate is out of bounds.
	 */
	public function __constructor($x, $y, $z)
	{
		if(!is_numeric($x) || !is_numeric($y) || !is_numeric($z))
		{
			?><p>Non-Numeric location value</p><?php
		}
		
		$this->x = $x;
		$this->y = $y;
		$this->z = $z;
	}	//end of Location constructor
	
	/**
	 * Returns the x coordinate of the location.
	 * 
	 * @return	Returns the x coordinate of the location.
	 */
	public function getX()
	{
		return $this->x;
	}	//end of getX method
	
	/**
	 * Returns the y coordinate of the location.
	 * 
	 * @return	Returns the y coordinate of the location.
	 */
	public function getY()
	{
		return $this->y;
	}	//end of getY method
	
	/**
	 * Returns the z coordinate of the location.
	 * 
	 * @return	Returns the z coordinate of the location.
	 */
	public function getZ()
	{
		return $this->z;
	}	//end of getZ method
}	//end of Location class
?>