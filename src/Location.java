/**
 * @author	Andrew Sytsma <asytsma@purdue.edu>
 */
public class Location
{
	/**
	 * Holds the x coordinate of the location.
	 */
	private final int x;
	
	/**
	 * Holds the y coordinate of the location.
	 */
	private final int y;
	
	/**
	 * Holds the z coordinate of the location.
	 */
	private final int z;
	
	/**
	 * Location constructor initializes fields.
	 * 
	 * @param x						The x coordinate of the location
	 * @param y						The y coordinate of the location
	 * @param z						The z coordinate of the location
	 * @throws LocationException	Throws an exception if the coordinate is out of bounds.
	 */
	public Location(int x, int y, int z) throws InvalidLocationException
	{
		//check if the x coordinate is valid
		if (x < 0 || x > 3)
		{
			throw new InvalidLocationException("Invalid x coordinate:  " + x);
		}	//end if
		
		//check if the y coordinate is valid
		if (y < 0 || y > 3)
		{
			throw new InvalidLocationException("Invalid y coordinate:  " + y);
		}	//end if
		
		//check if the z coordinate is valid
		if (z < 0 || z > 3)
		{
			throw new InvalidLocationException("Invalid z coordinate:  " + z);
		}	//end if
		
		this.x = x;
		this.y = y;
		this.z = z;
	}	//end of Location constructor
	
	/**
	 * Returns the x coordinate of the location.
	 * 
	 * @return	Returns the x coordinate of the location.
	 */
	public int getX()
	{
		return this.x;
	}	//end of getX method
	
	/**
	 * Returns the y coordinate of the location.
	 * 
	 * @return	Returns the y coordinate of the location.
	 */
	public int getY()
	{
		return this.y;
	}	//end of getY method
	
	/**
	 * Returns the z coordinate of the location.
	 * 
	 * @return	Returns the z coordinate of the location.
	 */
	public int getZ()
	{
		return this.z;
	}	//end of getZ method
}	//end of Location class
