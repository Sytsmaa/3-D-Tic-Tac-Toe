<?php
	if(!isset($_SESSION["casual"]))
	{
		$_SESSION["casual"] = array(0, 0, 0);
		$_SESSION["easy"] = array(0, 0, 0);
		$_SESSION["medium"] = array(0, 0, 0);
		$_SESSION["hard"] = array(0, 0, 0);
		$_SESSION["impossible"] = array(0, 0, 0);
	}
	
	$casual = "W-" . $_SESSION["casual"][0] . ", L-" . $_SESSION["casual"][1] . ", T-" . $_SESSION["casual"][2];
	$easy = "W-" . $_SESSION["easy"][0] . ", L-" . $_SESSION["easy"][1] . ", T-" . $_SESSION["easy"][2];
	$medium = "W-" . $_SESSION["medium"][0] . ", L-" . $_SESSION["medium"][1] . ", T-" . $_SESSION["medium"][2];
	$hard = "W-" . $_SESSION["hard"][0] . ", L-" . $_SESSION["hard"][1] . ", T-" . $_SESSION["hard"][2];
	$impossible = "W-" . $_SESSION["impossible"][0] . ", L-" . $_SESSION["impossible"][1] . ", T-" . $_SESSION["impossible"][2];
?>
<aside>
    <ul>
        <li>Casual<br /><?php echo $casual;?></li>
        <li>Easy<br /><?php echo $easy;?></li>
        <li>Medium<br /><?php echo $medium;?></li>
        <li>Hard<br /><?php echo $hard;?></li>
        <li>Impossible<br /><?php echo $impossible;?></li>
    </ul>
</aside>