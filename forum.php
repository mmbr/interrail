<?php include("header.php"); 

	if(!empty($_POST)) {
		if (isset($_POST['addthread'])){
			
			$query = "INSERT INTO forum_topics ( topic_name, topic_description, topic_date, topic_cat, topic_by ) VALUES ( :name, :desc, :date, :cat, :author)"; 
					
				
				$query_params = array( 
					':name' => $_POST['threadname'],
					':desc' => $_POST['threaddesc'],
					':date' => date("Y-m-d H:i:s"),
					':cat' => $_POST['addthread'],
					':author'=> $_SESSION['user']['id'],
				);
			
			$stmt = $db->prepare($query); 
			$result = $stmt->execute($query_params);
		}
		if (isset($_POST['addcoment'])){
			
			$query = "INSERT INTO forum_posts ( post_content, post_date, post_cat, post_topic, post_by ) VALUES 
			( :content, :date, :cat, :thread, :author)"; 
					
				
				$query_params = array( 
					':content' => $_POST['coment'],
					':date' => date("Y-m-d H:i:s"),
					':cat' => $_POST['thread'],
					':thread' => $_POST['addcoment'],
					':author'=> $_SESSION['user']['id'],
				);
			
			$stmt = $db->prepare($query); 
			$result = $stmt->execute($query_params);
		}
	}



?>
	<div id="divForum">
				<?php if (isset($_GET['topic'])) { 
					
					$query ="UPDATE forum_topics SET topic_views = topic_views + 1 WHERE topic_id = '". $_GET['topic']."'";
				
					$stmt = $db->prepare($query); 
					$stmt->execute();
				
					$query = "SELECT * FROM forum_categories WHERE shortURL = '". $_GET['cat']."'"; 
				
					$stmt = $db->prepare($query); 
					$stmt->execute();
																 
					$row = $stmt->fetch();
					
					$query0 = "SELECT * FROM forum_topics WHERE topic_id = '". $_GET['topic']."'"; 
				
					$stmt0 = $db->prepare($query0); 
					$stmt0->execute();
																 
					$row0 = $stmt0->fetch(); ?>
					<nav id="forum">

						<div id="forum_space">  <a href = "forum.php"> <h13> [FORUM] </h13> <br> </a>   </div>
						<h10><a href = "?cat=<?php echo $row['shortURL'];?>"><?php echo $row['cat_name'];?></a> » <?php echo $row0['topic_name'];?></h10>

						  <br>
						  <br>

						  <svg height="11" width="200" id="forumsvg"><line x1="0" y1="0" x2="20" y2="0" /></svg> 

						  <br>
						  <br>
						  <br>
		  
						<fieldset id="formInfo">
							<?php $query1 = "SELECT * FROM forum_posts WHERE post_topic=". $_GET['topic']; 
							
								$stmt1 = $db->prepare($query1); 
								$stmt1->execute();
																			 
								$rows1 = $stmt1->fetchAll();
								$i = 1;
								if(empty($rows1)){ 
									echo "no comments";
						
								}	
								foreach($rows1 as $row1): 

									$query2 = "SELECT * FROM people WHERE id =". $row1['post_by']; 
									
									$stmt2 = $db->prepare($query2); 
									$stmt2->execute();
																							 
									$row2 = $stmt2->fetch();

									$datD = date("j", strtotime($row1['post_date']));
									
									$datM = date("M", strtotime($row1['post_date']));
?>


									<li class="forum_li">

										<div id="textboxUm">
											<p class="alignleft" style="margin: 0 0 0">#<?php echo $i++; ?></p>
										</div>

										<br>

										<h11><?php echo $row1['post_content'];?></h11>

										<div id="forumUm_legenda">
											<p class="alignleft"> by _<?php echo $row2['username'];?> </p>
											<p class="alignleft"> <?php echo $datD ." ". $datM ." ". date("Y", strtotime($row1['post_date']));?> </p>
											<p class="alignleft"> <?php echo date("H", strtotime($row1['post_date'])) . ":" . date("i", strtotime($row1['post_date']));;?> pm </p>

										</div>
									</li>
								<?php endforeach; ?>
								<br/><br/><br/>
								
									<form action="forum.php?cat=<?php echo $_GET['cat'];?>&topic=<?php echo $_GET['topic'];?>" method="post" data-toggle="validator" role="form" >
										<fieldset id="contactform">
											<textarea name="coment" id="textarea" placeholder="YOUR COMMENT" onfocus="this.placeholder = ''" required></textarea>
										</fieldset>
										
										<input type="hidden" name="addcoment" value="<?php echo $_GET['topic'];?>">
										<input type="hidden" name="thread" value="<?php echo $row['cat_id'];?>">
										<input type="submit" value="reply" id="submitcontact">
									</form>
										
				<?php }else if (isset($_GET['add'])) { 
				
					$query = "SELECT * FROM forum_categories WHERE shortURL = '". $_GET['add']."'"; 
				
					$stmt = $db->prepare($query); 
					$stmt->execute();
																 
					$row = $stmt->fetch(); ?>
					
					<nav id="forum">

						<div id="forum_space">  <a href = "forum.php"> <h13> [FORUM] </h13> <br> </a>   </div>
						<h10><?php echo $row['cat_name'];?></h10>

						  <br>
						  <br>

						  <svg height="11" width="200" id="forumsvg"><line x1="0" y1="0" x2="20" y2="0" /></svg> 

						 <br>
						 <br>
						<form action="forum.php?cat=<?php echo $_GET['add'];?>" method="post" data-toggle="validator" role="form" >
							<fieldset id="contactform">
								<input id="threadname" type="text" name="threadname" placeholder="thread name" required></input>
								<svg height="7" class="formline">
									<line x1="0" y1="0" x2="1000" y2="0" style="stroke:black;stroke-width:7" />
								</svg>
								<br/><br/>
								<textarea name="threaddesc" id="textarea" placeholder="THREAD DESCRIPTION" onfocus="this.placeholder = ''" required></textarea>

							</fieldset>
							
							<input type="hidden" name="addthread" value="<?php echo $row['cat_id'];?>">
							<input type="submit" value="add thread" id="submitcontact">
						</form>
					</nav>
				
				<?php }else if (isset($_GET['cat'])) { 
				
					$query = "SELECT * FROM forum_categories WHERE shortURL = '". $_GET['cat']."'"; 
				
					$stmt = $db->prepare($query); 
					$stmt->execute();
																 
					$row = $stmt->fetch(); ?>
					
					<nav id="forum">

						<div id="forum_space">  <a href = "forum.php"> <h13> [FORUM] </h13> <br> </a>   </div>
						<h10><?php echo $row['cat_name'];?></h10>

						  <br>
						  <br>

						  <svg height="11" width="200" id="forumsvg"><line x1="0" y1="0" x2="20" y2="0" /></svg> 

						  <input type="submit" value="New Topic" id="submitcontact" onclick="window.location='forum.php?add=<?php echo $_GET['cat'];?>';">
						  <br>
						<form>
						<fieldset id="formInfo">
					
					<?php $query1 = "SELECT * FROM forum_topics WHERE topic_cat =". $row['cat_id'] . " ORDER BY topic_date DESC;"; 
				
					$stmt1 = $db->prepare($query1); 
					$stmt1->execute();
																 
					$rows1 = $stmt1->fetchAll();	
					foreach($rows1 as $row1):

						$query2 = "SELECT * FROM people WHERE id =". $row1['topic_by']; 
						
						$stmt2 = $db->prepare($query2); 
						$stmt2->execute();
																				 
						$row2 = $stmt2->fetch();
						
						$query3 = "SELECT Count(*) as posts FROM forum_posts WHERE post_topic =". $row1['topic_id']; 
						
						$stmt3 = $db->prepare($query3); 
						$stmt3->execute();
																				 
						$row3 = $stmt3->fetch();						?>
							
							<li class="forum_li">

								<div id="textboxUm">
									  <a href = "?cat=<?php echo $row['shortURL'];?>&topic=<?php echo $row1['topic_id'];?>">
										<p class="alignleft" style="margin: 0 0 0"><?php echo $row1['topic_name'];?></p>
									  </a>
								</div>

								<br>

								<h11><?php echo $row1['topic_description'];?></h11>

								<div id="forumUm_legenda">
									<p class="alignleft"> by _<?php echo $row2['username'];?> </p>
									<p class="alignleft"> <?php echo $row3['posts'];?> reviews </p>
									<p class="alignleft"> <?php echo $row1['topic_views'];?> views </p>
								</div>

						   </li>
						<?php endforeach; ?>
						</fieldset>
						</form>
					</nav>

                <?php }else{?>
					
				<nav id="forum">
					<fieldset id="formInfo">
			
					<?php $query = "SELECT * FROM forum_categories "; 
				
					$stmt = $db->prepare($query); 
					$stmt->execute();
																 
					$rows = $stmt->fetchAll();	
					foreach($rows as $row): 
					
						$query1 = "SELECT Count(*) as topics FROM forum_topics WHERE topic_cat =". $row['cat_id']; 
				
						$stmt1 = $db->prepare($query1); 
						$stmt1->execute();
																	 
						$row1 = $stmt1->fetch();
					
						$query2 = "SELECT Count(*) as posts FROM forum_posts WHERE post_cat =". $row['cat_id']; 
						
						$stmt2 = $db->prepare($query2); 
						$stmt2->execute();
																				 
						$row2 = $stmt2->fetch(); ?>
						
						<li class="forum_li">

							<div id="textbox">
							  <a href = "?cat=<?php echo $row['shortURL'];?>">
							  <p class="alignleft"><?php echo $row['cat_name']; ?></p>
							  <p class="alignright"><?php echo $row1['topics']; ?> threads</p>
							  
							  <p class="alignright"><?php echo $row2['posts']; ?> posts</p>
							  </a>
							</div>

							<svg height="7" class="forumline" id="forumsvg"><line x1="0" y1="0" x2="29.5%" y2="0" /></svg> 

							<h11><?php echo $row['cat_description']; ?></h11>


					   </li>
               
						
					<?php endforeach; ?>
					</fieldset>
				</nav>
			<?php } ?>
	</div>

</body>

</html>
