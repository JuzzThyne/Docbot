
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/indexnav.css">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height:15%; font-size:20px;">
  <div class="container-fluid">
    <a href="index.php"><img src="image/docbot_logo.png" alt="Logo" width="200" height="50" class="d-inline-block align-text-center"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
   

    <ul class="navbar-nav" style="color:white;">

    	
	    <li class="nav-item">
	        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
	    </li>

    	<!-- <h2>|</h2>
	    <li class="nav-item">
	        <a class="nav-link active" aria-current="page" href="chatbot.php">Ask About Medicine</a>
	    </li>

	    <h2>|</h2>
	   	<li class="nav-item">
	        <a class="nav-link active" aria-current="page" href="chatbotrecommend.php">Ask for Recommended Medicine</a>
	    </li> -->

	    <!-- <h2>|</h2>
	    <li class="nav-item">
	        <a class="nav-link active" aria-current="page" href="groupchat.php">Live Chat</a>
	    </li> -->

		 <?php
		 include'user_session.php';
		 ?>
	</ul>


    </div>
  </div>
</nav>
