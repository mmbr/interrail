<?php include("header.php");
	if(!empty($_POST)) { 
		if (isset($_POST['singin'])){
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
			  
			$query = "INSERT INTO people ( username, password, salt, name, email, city, birthday) VALUES ( :username, :password, :salt, :name, :email, :city, :birthday ) "; 
			 
			$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
			 
			$password = hash('sha256', $_POST['password'] . $salt); 
			  
			for($round = 0; $round < 65536; $round++) 
			{ 
				$password = hash('sha256', $password . $salt); 
			} 
			  
			$query_params = array(  
				':username' => $_POST['username'], 
				':password' => $password, 
				':salt' => $salt, 
				':name' => $_POST['firstname']." ".$_POST['lastname'], 
				':email' => $_POST['email']	,
				':birthday' => date($_POST['birthdayyer']."-".$_POST['birthdaymon']."-".$_POST['birthdayday']." H:i:s"), 
				':city' => $_POST['city'], 
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
			  <input type="checkbox" id="female" onclick="radiobutton(this);"/>
			  <label for="female">Female</label>
			  <input type="checkbox" id="male" onclick="radiobutton(this);"/>
			  <label for="male" id="male">Male</label>
		  </p>   
		</ul>
		<ul>
      BIRTHDAY <br>

      <select name="birthdayday" id="birthdayoption">
        <option>DAY ------</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select>

      <select name="birthdaymon" id="birthdayoption">
        <option>MONTH ---</option>
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


      <select name="birthdayyer" id="birthdayoption">
        <option>YEAR -----</option>
        <option value="2008">2008</option>
        <option value="2007">2007</option>
        <option value="2006">2006</option>
        <option value="2005">2005</option>
        <option value="2004">2004</option>
        <option value="2003">2003</option>
        <option value="2002">2002</option>
        <option value="2001">2001</option>
        <option value="2000">2000</option>
        <option value="1999">1999</option>
        <option value="1998">1998</option>
        <option value="1997">1997</option>
        <option value="1996">1996</option>
        <option value="1995">1995</option>
        <option value="1994">1994</option>
        <option value="1993">1993</option>
        <option value="1992">1992</option>
        <option value="1991">1991</option>
        <option value="1990">1990</option>
        <option value="1989">1989</option>
        <option value="1988">1988</option>
        <option value="1987">1987</option>
        <option value="1986">1986</option>
        <option value="1985">1985</option>
        <option value="1984">1984</option>
        <option value="1983">1983</option>
        <option value="1982">1982</option>
        <option value="1981">1981</option>
        <option value="1980">1980</option>
        <option value="1979">1979</option>
        <option value="1978">1978</option>
        <option value="1977">1977</option>
        <option value="1976">1976</option>
        <option value="1975">1975</option>
        <option value="1974">1974</option>
        <option value="1973">1973</option>
        <option value="1972">1972</option>
        <option value="1971">1971</option>
        <option value="1970">1970</option>
        <option value="1969">1969</option>
        <option value="1968">1968</option>
        <option value="1967">1967</option>
        <option value="1966">1966</option>
        <option value="1965">1965</option>
        <option value="1964">1964</option>
        <option value="1963">1963</option>
        <option value="1962">1962</option>
        <option value="1961">1961</option>
        <option value="1960">1960</option>
        <option value="1959">1959</option>
        <option value="1958">1958</option>
        <option value="1957">1957</option>
        <option value="1956">1956</option>
        <option value="1955">1955</option>
        <option value="1954">1954</option>
        <option value="1953">1953</option>
        <option value="1952">1952</option>
        <option value="1951">1951</option>
        <option value="1950">1950</option>
        <option value="1949">1949</option>
        <option value="1948">1948</option>
        <option value="1947">1947</option>
        <option value="1946">1946</option>
        <option value="1945">1945</option>
      </select>
      
              <fieldset id="signinform">
                
                <input id="city" type="text" name="city" placeholder="City" required>  </input>
                  <svg height="7" width="550">
                  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
                  </svg> 
                
                <input id="firstname" type="text" name="firstname" placeholder="firstname" required></input>
                  <svg height="7" width="550">
                  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
                  </svg> 

                <input id="lastname" type="text" name="lastname" placeholder="lastname" required></input>
                  <svg height="7" width="550">
                  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
                  </svg>

                <input id="username" type="text" name="username" placeholder="username" required>  </input>
                  <svg height="7" width="550">
                  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
                  </svg> 
                
                <input id="email" type="text" name="email" placeholder="email" required></input>
                  <svg height="7" width="550">
                  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
                  </svg> 

                <input id="password" type="password" name="password" placeholder="password" required></input>
                  <svg height="7" width="550">
                  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
                  </svg>

                <input id="confirmpassword" type="password" name="confirmpassword" placeholder="confirm password" required></input>
                  <svg height="7" width="550">
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