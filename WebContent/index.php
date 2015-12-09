<?php
$title="3D Tic-Tac-Toe";
$homeDir="";
require_once("layout/header.php");
?>
	<?php require_once("layout/scores.php");?>
    <div id="game">
    	<h1>3D Tic-Tac-Toe</h1>
    	<div id="center">
          <button value="Casual">Casual</button>
          <button value="Easy">Easy</button>
          <button value="Medium">Medium</button>
          <button value="Hard">Hard</button>
          <button value="Impossible">Impossible</button>
        </div>
    </div>
<?php
require_once("layout/footer.php");
?>