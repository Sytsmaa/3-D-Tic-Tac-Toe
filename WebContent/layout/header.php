<?php
session_start();
require_once($homeDir . "database/data.php");
?>
<!DOCTYPE html>
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="<?php echo $homeDir; ?>layout/design.css" />
<link rel="icon" type="image/png" href="/favicon.png" />

<?php if(isset($game) && $game === true) echo "<script src='scripts/game-script.js'></script>"; ?>

<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<title><?php echo $title;?></title>
</head>

<body>
<header>
	<a href="<?php echo $homeDir;?>index.php"><h1>3D Tic-Tac-Toe</h1></a>
    <aside>
    	<nav>
        	<?php
				if(!isset($_SESSION["username"]))
				{
        			echo "<a href='" . $homeDir . "login.php'>Log In</a> |
            			<a href='" . $homeDir . "signup.php'>Sign Up</a>";
				}
				else
				{
					echo $_SESSION["username"] . " | <a href='" . $homeDir . "logout.php'> Log Out</a>";
				}
			?>
        </nav>
    </aside>
</header>
<section id="content">