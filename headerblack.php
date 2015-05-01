
<html>

  <head>

    <title>Bootstrap 101 Template</title>
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

      <script>
      $(function() {

        var loc = window.location.href;

        if (loc.toLowerCase().indexOf("about") >= 0){
          $('nav a[href^="about.php').addClass('active');
        } else if(loc.toLowerCase().indexOf("theteam") >= 0){
          $('nav a[href^="theteam.php').addClass('active');
        } else if(loc.toLowerCase().indexOf("contact.php") >= 0){
          $('nav a[href^="contact.php').addClass('active');
        } else if(loc.toLowerCase().indexOf("forum") >= 0){
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

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>


  <script type="text/javascript"> 

    $(document).ready(function() {
         ChangeIt();
    });

    function ChangeIt() 
    {
    var totalCount = 3;
    var num = Math.ceil( Math.random() * totalCount );
    document.body.background = 'css/img/background/'+num+'.jpg';
    }

    function login() 
    {
       if(document.getElementById("logincontent").style.display == "block"){
          document.getElementById("logincontent").style.display = "none";
       } else {
          document.getElementById("logincontent").style.display = "block";
       }
    }

     function validarLogin() 
    {
       document.getElementById("logincontent").style.display = "none";
    }
    
    
    </script>
    </head>

  </head>

  <body>



    

   <!--MENU-->

   <header>

   <div id="menu">

     <a href="index.php"><img id = "logoimg" src="css/img/logoyellow.png" id="img" > </a>
	   <a href="index.php"> <p id="logo"> InterrailGuide </p> </a>

	    <nav id="menulink">
  		 	<li id="menulink">
  			    <ul><a href="about.php"> About </a></ul>
  			    <ul><a href="theteam.php"> The Team </a></ul>
  			    <ul><a href="contact.php"> Contact </a></ul>
            <ul><a href="forum.php"> Forum </a></ul>
  			</li>
		</nav>

   </div>



   <nav id="login">
        <ul id="loginlink">
            <li><a href="signin.php"> sign in </a></li>
            <li> . </li>
            <li><a onclick="login()"> login </a></li>
        </ul>

        <div id="logincontent">
            <form>
              <fieldset id="inputs">
                <input id="username" type="email" name="Email" placeholder="Username/E-mail" required>  </input>
                  <svg height="7" width="200">
                  <line x1="0" y1="0" x2="200" y2="0" style="stroke:yellow;stroke-width:7" />
                  </svg> 
                <input id="password" type="password" name="Password" placeholder="Password" required></input>
                  <svg height="7" width="200">
                  <line x1="0" y1="0" x2="200" y2="0" style="stroke:yellow;stroke-width:7" />
                  </svg> 
              </fieldset>
              <fieldset id="actions">
                <label> Forget my password </label>
                <input type="submit" id="submit" value="OK" onclick="validarLogin()">
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


    
