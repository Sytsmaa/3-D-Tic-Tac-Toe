/**
 * @author	Andrew Sytsma <asytsma@purdue.edu>
 * 
 * Used to throw an exception if there is an invalid coordinate.
 */
public class InvalidLocationException extends RuntimeException
{
	/**
	 * InvalidLocationException constructor calls its super class.
	 * 
	 * @param error	The error message to display.
	 */
	public InvalidLocationException(String error)
	{
		super(error);
	}	//end of InvalidLocaitonException constructor
}	//end of LocationException class