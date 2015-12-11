<?php
/**
 * @author	Andrew Sytsma <asytsma@purdue.edu>
 */
interface Piece
{
	/**
	 * Returns the picture of the piece.
	 * 
	 * @return	Returns the picture of the piece.
	 */
	public function getPicture();
	
	/**
	 * Returns the location of the piece.
	 * 
	 * @return	Returns the location of the piece.
	 */
	public function getLocation();
}	//end of Piece interface
?>