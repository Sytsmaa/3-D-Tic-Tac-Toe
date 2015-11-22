import java.awt.Image;

public class O //implements Piece
{
	/**
	 * Holds the picture of the O.
	 */
	//private final Image picture;
	
	/**
	 * Holds the location of the O.
	 */
	private final Location location;
	
	/**
	 * O constructor initializes fields.
	 * 
	 * @param location	The location of the O.
	 */
	public O(Location location)
	{
		//this.picture = picture of an O;
		this.location = location;
	}	//end of X constructor
	
	/**
	 * Returns the picture of the O.
	 * 
	 * @return	Returns the picture of the O.
	 */
	/*public Image getPicture()
	{
		return this.picture;
	}	//end of getPicture method
	
	/**
	 * Returns the location of the O.
	 * 
	 * @return	Returns the location of the O.
	 */
	public Location getLocation()
	{
		return this.location;
	}	//end of getLocation method
}
