<?php include ("bd.php"); 


					
						

				$resultright = mysql_query ("SELECT * FROM reviews ORDER BY id DESC LIMIT 0, 5",$db);
				$myrowright = mysql_fetch_array ($resultright) or die ();
		
		do
					{
						$id = $myrowright["id"];	
						$rew_link = $myrowright["rew_link"];	
						$rew_author = $myrowright["rew_author"];
						$rew_text = $myrowright["rew_text"];
						 
							print ("<div class='reviews-each'>");
								
								print ("<img class='reviews-mini' src='/img/reviews/$rew_link' alt='$rew_author' >");
								print ("<h4>$rew_author</h4>");
								print ("<p>$rew_text</p>");
								print ("<p><a href='/otzivy/'>Читать все отзывы>></a></p>");
							print ("</div>");
						
					}

		while ($myrowright = mysql_fetch_array($resultright));


         
        
  ?>  
