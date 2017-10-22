<!DOCTYPE html>
<html lang ="en">
<head>
	<meta charset="utf-8">
	<meta name = "viewport" content="width-device-width, initial-scale = 1">
	<link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel = "stylesheet" href="hh_style2.css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script scr = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/jk/bootstrap.min.js"></script>

</head>
<body>

	<div class = "container" id = "header">
		<div class = "jumbotron" align = "center">
		<h1 class  = "display-3">
		<?php
			$word = $_POST["word"];
			echo $word;
		?>
		</h1>
		</div>
		<!--
			get the word from the search 
		-->
		<h1 align = "center">
		Some description
		 <!--<?php

		 ?>-->
		</h1>
	</div>

	<!--<div class = "container" id = "wordStuff">
		
		<?php /*
		 $definition = $_GET[];
		 echo $definition. "</br>";
		$json = file_get_contents("http...");
		$description = json_decode($json);
		echo $data->("token"); */
		?>
	</div> -->
	
	<div class = "container" id = "vidGallery">
		<?php
			echo "<div class = 'container'>";
			for ($row = 0; $row <= 3; $row++){
				echo "<div class = 'row'>";
				for($col = 0; $col <= 3; $col++){
					echo "<div class  = 'col-sm-3'>
					<videos controls = 'controls' preload = 'metadata'>
						<source src = ''>
					</videos>
					</div>";
				}
				echo "</div>";
			}
		?>
	</div>
	<!--
	for the length of the array of videos returned take the thumbnail and display it on the the net 
	
	-->
	<footer>
		<h5 align="right">
		Weerd!
		</h5>
	</footer>
</body>
</html>