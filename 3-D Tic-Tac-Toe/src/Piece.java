import java.awt.Image;

/**
 * @author	Andrew Sytsma <asytsma@purdue.edu>
 */
public interface Piece
{
	/**
	 * Returns the picture of the piece.
	 * 
	 * @return	Returns the picture of the piece.
	 */
	public Image getPicture();
	
	/**
	 * Returns the location of the piece.
	 * 
	 * @return	Returns the location of the piece.
	 */
	public Location getLocation();
}	//end of Piece interface
