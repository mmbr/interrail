<?php  include("header.php");
	if (!empty($_POST)) {
		if (isset($_POST['contact'])){
			date_default_timezone_set('Europe/London');
			
			$query = "INSERT INTO contact( date, name, email, subject, msg ) VALUES (:date, :name, :email, :title, :msg )"; 
			
			$msg = ereg_replace( "\n",'<br/>', htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8'));
			
			$query_params = array( 
				':date' => date("Y-m-d H:i:s"),
				':name' => $_POST['firstname'] ." ". $_POST['firstname'],
				':email' => $_POST['email'],
				':title' => $_POST['subject'],
				':msg' => $msg,
			);
			
			$stmt = $db->prepare($query); 
			$result = $stmt->execute($query_params);
		}			

	} ?>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  

  <div id="divContact">
  
 
	  <nav id="contact">

			<?php if (!empty($_POST)) { ?>
							
				<div>
					<h2>Obrigado <?php echo $_POST['firstname']." ".$_POST['lastname'];?></h2>

					<p>Entraremos em contacto contigo o mais depressa possível. </p>
				</div>
							
							
							
			<?php }else{ ?>
		  <form action="contact.php" method="post" data-toggle="validator" role="form">
		  
				  <fieldset id="contactform">
					
									
					<input id="firstname" type="text" name="firstname" placeholder="firstname" required></input>
					  <svg height="7" class="formline">
					  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
					  </svg> 

					<input id="lastname" type="text" name="lastname" placeholder="lastname" required ></input>
					  <svg height="7" class="formline">
					  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
					  </svg>
					
					 <input id="email" type="email" name="email" placeholder="your e-mail" required></input>
					  <svg height="7" class="formline" >
					  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
					  </svg> 

					  <input id="subject" type="text" name="subject" placeholder="subject" required></input>
					  <svg height="7" class="formline">
					  <line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
					  </svg>
					
					<br><br><br>
					<textarea name="message" id="textarea" placeholder="WRITE HERE" onfocus="this.placeholder = ''" required></textarea>

								  
				  </fieldset>
				<input type="hidden" name="contact">
				<input type="submit" value="Send" id="submitcontact">

		  </form>
		<?php } ?>

	  </nav>

  </div>

  </body>

</html>