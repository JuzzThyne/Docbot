<?php
		// Start the session
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		// Check if the user is already logged in
		if (isset($_SESSION['username'])) {
			echo '<h2>|</h2>';
			echo '<li class="nav-item">';
			echo '<a class="nav-link active" aria-current="page" href="groupchat.php">Live Chat</a>';
			echo '</li>';
			echo '<h2>|</h2>';
			echo '<li class="nav-item">';
			echo '<a class="nav-link active" aria-current="page" href="logout.php">Logout</a>';
			echo '</li>';
		}
		else{
			echo '<h2>|</h2>';
			echo '<li class="nav-item">';
			echo '<a class="nav-link active" aria-current="page" href="login.php">Login</a>';
			echo '</li>';
			
		}		
?>	    