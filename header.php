<?php require("config.php"); 
   
    $submitted_username = ''; 
     
    if(!empty($_POST)) { 
		if (isset($_POST['login'])){
			$query = "SELECT * FROM people WHERE username = :username"; 
			 
			$query_params = array( 
				':username' => $_POST['username'] 
			); 
			
			try { 
				$stmt = $db->prepare($query); 
				$result = $stmt->execute($query_params); 
			} 
			catch(PDOException $ex) {  
				die("Failed to run query: " . $ex->getMessage()); 
			} 
			 
			$login_ok = false; 
			 
			$row = $stmt->fetch(); 
			if($row) { 
				$check_password = hash('sha256', $_POST['password'] . $row['salt']); 
				for($round = 0; $round < 65536; $round++) 
				{ 
					$check_password = hash('sha256', $check_password . $row['salt']);
				} 
				 
				if($check_password === $row['password']) 
				{ 
					$login_ok = true;
				} 
			} 
			 
			if($login_ok){  
				unset($row['salt']); 
				unset($row['password']); 
				 
				$_SESSION['user'] = $row; 
				  
				//header("Location: private.php");
				//die(); 
			} 
			else {
				header( "Location: ?error=1");
				die();
			}
				 
			$submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
		}
	}		
	
	
	if (isset($_GET['off'])) { 
	 
		unset($_SESSION['logged_in']);
		session_destroy();
	 
	} ?>
<html>

  <head>

    <title>InterrailGuide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- css -->     	
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- fonts -->
    <link href='http://fonts.googleapis.com/css?family=Advent+Pro:700,400,300,600,500' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>

      <script>
      $(function() {

        var loc = window.location.href;

        if (loc.toLowerCase().indexOf("about") >= 0){
          $('nav a[href^="about.php').addClass('active');
        } else if(loc.toLowerCase().indexOf("theteam") >= 0){
          $('nav a[href^="theteam.php').addClass('active');
        } else if(loc.toLowerCase().indexOf("contact.php") >= 0){
          $('nav a[href^="contact.php').addClass('active');
        } else if(loc.toLowerCase().indexOf("forum.php") >= 0){
          $('nav a[href^="forum.php').addClass('active');
        } else if(loc.toLowerCase().indexOf("contactme.php") >= 0){
              $('nav a[href^="contactme.php').addClass('active');
          } else {
              
          }
      });
    </script>

    <!-- slide -->

  <!-- SlidesJS Required (if responsive): Sets the page width to the device width. -->
  <meta name="viewport" content="width=device-width">
  <!-- End SlidesJS Required -->

  <!-- CSS for slidesjs.com example -->
  <link rel="stylesheet" href="css/example.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- End CSS for slidesjs.com example -->

  <script type="text/javascript" src="js/javascript.js"></script>

    </head>

  </head>

  <body>

    

   <!--MENU-->

   <header>

   <div id="menu">

     <a href="index.php"><img id = "logoimg" src="css/img/logoyellow.png" id="img" > </a>
	   <a href="index.php"> <p id="logo"> InterrailGuide </p> </a>

	    <nav id="menulink">
  		 	<li id="menulink" >
  			    <ul><a href="about.php" > About </a></ul>
  			    <ul><a href="theteam.php"  > The Team </a></ul>
  			    <ul><a href="contact.php" > Contact </a></ul>
            <ul><a href="forum.php"  > Forum </a></ul>
  			</li>
		</nav>

   </div>



   <nav id="login">
        <ul id="loginlink">
            <li><a href="signin.php"> sign in </a></li>
            <li> . </li>
			<?php if(empty($_SESSION['user'])){ ?>
				<li><a onclick="login()"> login </a></li>
			<?php }else{ ?>
				<li><a href="?off"> logoff </a></li>
			<?php } ?>
        </ul>

        <div id="logincontent">
		<?php if (isset($_GET['error'])) { if ($_GET['error'] == 1) { ?>
			<div>Falha no login!</div>
		<?php } } ?>
            <form action="" method="post">
              <fieldset id="inputs">
                <input id="username" type="text" name="username" placeholder="Username" required>  </input>
                  <svg height="7" width="200" id="loginsvg">
                  <line x1="0" y1="0" x2="200" y2="0" />
                  </svg> 
                <input id="password" type="password" name="password" placeholder="Password" required></input>
                  <svg height="7" width="200" id="loginsvg">
                  <line x1="0" y1="0" x2="200" y2="0" />
                  </svg> 
              </fieldset>
              <fieldset id="actions">
                <label> Forget my password </label>
				<input type="hidden" name="login">
				<button type="submit" id="submit" value="Login">OK</button>
              </fieldset>
            </form>
          </div>     
   </nav>

<!--
   <nav>
      <ul>
        <li id="login">
          <a id="login-trigger" href="#">
            Log in <span>▼</span>
          </a>
          <div id="login-content">
            <form>
              <fieldset id="inputs">
                <input id="username" type="email" name="Email" placeholder="Your email address" required>   
                <input id="password" type="password" name="Password" placeholder="Password" required>
              </fieldset>
              <fieldset id="actions">
                <input type="submit" id="submit" value="Log in">
                <label><input type="checkbox" checked="checked"> Keep me signed in</label>
              </fieldset>
            </form>
          </div>                     
        </li>
        <li id="signup">
          <a href="">Sign up FREE</a>
        </li>
      </ul>
    <nav>
  -->


 </header>