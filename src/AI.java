import java.util.Random;
import java.util.ArrayList;

public class AI implements Player {
	
	/**
	* The simplest AI level. This AI just plays randomly and won't even attempt to win.
	* It's like playing a two year old.
	*/
	public static final int AI_LEVEL_CASUAL = 0;
	
	/**
	* The simple AI level. This AI just plays randomly, and will
	* only attempt to win if it manages to have all but one piece
	* in a line.
	*/
	public static final int AI_LEVEL_EASY = 1;
	
	/**
	* This AI level will most of the time block the player, but
	* will sometimes suffer from tunnel vision and miss a block.
	*/
	public static final int AI_LEVEL_MEDIUM = 2;
	
	/**
	* This AI level will always block the player if the player is about
	* to win. Therefore, the player has to have multiple ways of winning
	* to beat the AI.
	*/
	public static final int AI_LEVEL_HARD = 3;
	
	/**
	* The hardest AI level. This AI cannot be beaten, only tied with.
	*/
	public static final int AI_LEVEL_IMPOSSIBLE = 4;
	
	//Private fields about the AI
	public int level;
	
	public AI() {
		//We'll assume medium is the default, just in case.
		this(AI_LEVEL_MEDIUM);
	}
	
	public AI(int level) {
		//This is to make sure a valid level is passed
		switch(level) {
			case AI_LEVEL_CASUAL:
				this.level = AI_LEVEL_CASUAL;
			case AI_LEVEL_EASY:
				this.level = AI_LEVEL_EASY;
			case AI_LEVEL_MEDIUM:
				this.level = AI_LEVEL_MEDIUM;
			case AI_LEVEL_HARD:
				this.level = AI_LEVEL_HARD;
			case AI_LEVEL_IMPOSSIBLE:
			default:
				this.level = AI_LEVEL_IMPOSSIBLE;
		}
	}
	
	public String getUsername() {
		String aiTitle = "AI - ";
		switch(level) {
			case AI_LEVEL_CASUAL:
				return aiTitle + "Casual";
			case AI_LEVEL_EASY:
				return aiTitle + "Easy";
			case AI_LEVEL_MEDIUM:
				return aiTitle + "Medium";
			case AI_LEVEL_HARD:
				return aiTitle + "Hard";
			case AI_LEVEL_IMPOSSIBLE:
				return aiTitle + "Impossible";
		}
		return aiTitle + "Unknown";
	}

	public Location getNextMove(Board b) {
		if (level == AI_LEVEL_CASUAL) return b.getAvailableMoves().get(new Random().nextInt(b.getAvailableMoves().size())); //Just pick a random location. Who cares?
		return null;
	}
}
