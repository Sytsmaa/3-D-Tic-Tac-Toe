import java.awt.Image;

/**
 * @author	Andrew Sytsma <asytsma@purdue.edu>
 */
public class X implements Piece
{
	/**
	 * Holds the picture of the X.
	 */
	private final Image picture;
	
	/**
	 * Holds the location of the X.
	 */
	private final Location location;
	
	/**
	 * X constructor initializes fields.
	 * 
	 * @param location	The location of the X.
	 */
	public X(Location location)
	{
		//this.picture = picture of an X;
		this.location = location;
	}	//end of X constructor
	
	/**
	 * Returns the picture of the X.
	 * 
	 * @return	Returns the picture of the X.
	 */
	public Image getPicture()
	{
		return this.picture;
	}	//end of getPicture method
	
	/**
	 * Returns the location of the X.
	 * 
	 * @return	Returns the location of the X.
	 */
	public Location getLocation()
	{
		return this.location;
	}	//end of getLocation method
}	//end of X class
