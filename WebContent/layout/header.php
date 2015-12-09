<?php
session_start();
require_once($homeDir . "database/data.php");
?>
<!DOCTYPE html>
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="<?php echo $homeDir; ?>layout/design.css" />

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
        	<a href="<?php echo $homeDir; ?>login.php">Log In</a> |
            <a href="<?php echo $homeDir; ?>signup.php">Sign Up</a>
        </nav>
    </aside>
</header>
<section id="content">