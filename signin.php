<?php include("header.php");
	if(!empty($_POST)) { 
		if (isset($_POST['singin'])){
			date_default_timezone_set('Europe/London');
			
			if(empty($_POST['username'])){  
				die("Please enter a username."); 
			} 
			 
			if(empty($_POST['password'])){ 
				die("Please enter a password."); 
			} 
			 
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 
				die("Invalid E-Mail Address"); 
			} 
			  
			$query = "SELECT 1 FROM people WHERE username = :username"; 
			 
			$query_params = array( 
				':username' => $_POST['username'] 
			); 
			 
			$stmt = $db->prepare($query); 
			$result = $stmt->execute($query_params); 
			 
			$row = $stmt->fetch(); 
			  
			if($row){ 
				die("This username is already in use"); 
			} 
			 
			$query = "SELECT 1 FROM people WHERE email = :email"; 
			 
			$query_params = array( 
				':email' => $_POST['email'] 
			); 
			 
			$stmt = $db->prepare($query); 
			$result = $stmt->execute($query_params);
			 
			$row = $stmt->fetch(); 
			 
			if($row){ 
				die("This email address is already registered"); 
			} 
			  
			$query = "INSERT INTO people ( register, username, password, salt, name, email, city, birthday, sex) VALUES ( :date, :username, :password, :salt, :name, :email, :city, :birthday, :sex ) "; 
			 
			$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
			 
			$password = hash('sha256', $_POST['password'] . $salt); 
			  
			for($round = 0; $round < 65536; $round++) 
			{ 
				$password = hash('sha256', $password . $salt); 
			} 
			  
			$query_params = array( 
				':date' => date("Y-m-d H:i:s"),
				':username' => $_POST['username'], 
				':password' => $password, 
				':salt' => $salt, 
				':name' => $_POST['firstname']." ".$_POST['lastname'], 
				':email' => $_POST['email']	,
				':birthday' => date($_POST['birthdayyer']."-".$_POST['birthdaymon']."-".$_POST['birthdayday']), 
				':city' => $_POST['city'], 
				':sex' => $_POST['sex'], 
			); 
			 
			 
			try 
			{ 
				$stmt = $db->prepare($query); 
				$result = $stmt->execute($query_params); 
			} 
			catch(PDOException $ex) 
			{   
				die("Failed to run query: " . $ex->getMessage()); 
			} 
			 
			header("Location: index.php"); 
			  
			die(); 
		} 
	}?>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  

  <div id="divSignin">
  
 
  <nav id="signin">
  	<?php if (!empty($_POST)) { ?>
							
				<div>
					<h2>Obrigado <?php echo $_POST['firstname']." ".$_POST['lastname'];?></h2>

					<p>Seja muito bem vindo.</p>
				</div>
							
							
							
	<?php }else{ ?>
   <form action="signin.php" method="post" data-toggle="validator" role="form">
	  <li>
		<ul>
			<p>
			  <input type="checkbox" id="female" name="sex" value="1" onclick="radiobutton(this);" />
			  <label for="female">Female</label>
			  <input type="checkbox" id="male" name="sex" value="2" onclick="radiobutton(this);"/>
			  <label for="male" id="male">Male</label>
		  </p>   
		</ul>
		<ul>
      BIRTHDAY <br>

      <select name="birthdayday" id="birthdayoption" required>
        <option value="">DAY ------</option>
		<?php for ($i = 1; $i <= 31; $i++) { ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php } ?>
      </select>

      <select name="birthdaymon" id="birthdayoption" required>
        <option value="">MONTH ---</option>
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">Nobember</option>
        <option value="12">December</option>
      </select>

      <select name="birthdayyer" id="birthdayoption" required>
        <option value="">YEAR -----</option>
        <?php for ($i = date('Y', strtotime('-6 year')); $i >= date('Y', strtotime('-99 year')); $i--) { ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php } ?>
      </select>	
	  
              <fieldset id="signinform">
                
                <input id="city" type="text" name="city" placeholder="City" required>  </input>
                  <svg height="7" class="formline">
                  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
                  </svg> 
                
                <input id="firstname" type="text" name="firstname" placeholder="firstname" required></input>
                  <svg height="7" class="formline">
                  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
                  </svg> 

                <input id="lastname" type="text" name="lastname" placeholder="lastname" required></input>
                  <svg height="7" class="formline">
                  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
                  </svg>

                <input id="username" type="text" name="username" placeholder="username" required>  </input>
                  <svg height="7" class="formline">
                  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
                  </svg> 
                
                <input id="email" type="text" name="email" placeholder="email" required></input>
                  <svg height="7" class="formline">
                  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
                  </svg> 

                <input id="password" type="password" name="password" placeholder="password" required></input>
                  <svg height="7" class="formline">
                  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
                  </svg>

                <input id="confirmpassword" type="password" name="confirmpassword" placeholder="confirm password" required></input>
                  <svg height="7" class="formline">
                  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
                  </svg>
              
              </fieldset>

			<input type="hidden" name="singin">
            <input type="submit" value="Submit" id="submit">

      

		</ul>
   

	</li>
   </form>
   <?php }?>
  </nav>

  </div>

  </body>

</html>