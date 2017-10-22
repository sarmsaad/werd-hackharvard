<!DOCTYPE html>
<html lang ="en">
<head>
	<meta charset="utf-8">
	<meta name = "viewport" content="width-device-width, initial-scale = 1">
	<link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<<<<<<< Updated upstream
	<link rel = "stylesheet" type="text/css" href="hh_style2.css">
=======
<<<<<<< HEAD
	<link rel = "stylesheet" href="hh_style.css">
=======
	<link rel = "stylesheet" type="text/css" href="hh_style2.css">
>>>>>>> origin/master
>>>>>>> Stashed changes
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Alegreya' rel='stylesheet'>
	<script scr = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/jk/bootstrap.min.js"></script>
	<script type="text/javascript" src="definition.js"></script>
	<script type ="text/javascript" scr ="js/myJs2.js"></script>

</head>
<body>

	<div class = "container" id = "header">
		<div id = "spacer"></div>
		<div class = "jumbotron" align = "center" >
			<h1 class  = "theWord">
			<?php
				$word = $_GET["word"];
				echo $word;
			?>
			</h1>
		</div>
		<!--
			get the word from the search
		-->
		<h3 align = "center" id = "def">
			<?php
				// This function grabs the definition of a word in XML format.
				function grab_xml_definition ($word, $ref, $key)
					{

						$uri = "http://www.dictionaryapi.com/api/v1/references/" . urlencode($ref) . "/xml/" .
									urlencode($word) . "?key=" . urlencode($key);
				                		return file_get_contents($uri);
					};

				$xdef = grab_xml_definition($_GET["word"], "collegiate", "883faa22-6561-4b2c-8525-64b8979f2953");

				$xml = simplexml_load_string($xdef) or die("Error: Cannot create object");
				//first definition
				$string = str_replace(':', '', $xml->entry->def->dt[0]);
				echo $string . "<br>";
				//second definition
				$string = str_replace(':', '', $xml->entry->def->dt[1]);
				echo $string . "<br>";

			?>
		</h3>
	</div>



	<div class = "container" id = "vidGallery" align = "center">
		<!--<?php/*
		$word = $_POST["word"];
		$url = 'http://localhost:8080/werd?word=' . $word ;
		$json = file_get_contents($url);
		$obj = json_decode($json);

<<<<<<< HEAD
		$number =(int)$obj->{'number'};
		$video1 = "null";
		$video2 = "null";
		$video3 = "null";
		$video4 = "null";
		$video5 = "null";

		if($number>0){
			$video1 = $obj->{'video1'}->{'id'};
			$start1 = $obj->{'video1'}->{'startTime'};
			$end1 = $obj->{'video1'}->{'endTime'};
			$number = $number - 1;
			if($number>0){
				$video2 = $obj->{'video2'}->{'id'};
				$start2 = $obj->{'video2'}->{'startTime'};
				$end2 = $obj->{'video2'}->{'endTime'};
				$number = $number - 1;
				if($number>0){
					$video3 = $obj->{'video3'}->{'id'};
					$start3 = $obj->{'video3'}->{'startTime'};
					$end3 = $obj->{'video3'}->{'endTime'};
					$number = $number - 1;
					if($number>0){
						$video4 = $obj->{'video4'}->{'id'};
						$start4 = $obj->{'video4'}->{'startTime'};
						$end4 = $obj->{'video4'}->{'endTime'};
						$number = $number - 1;
						if($number>0){
							$video5 = $obj->{'video5'}->{'id'};
							$start5 = $obj->{'video5'}->{'startTime'};
							$end5 = $obj->{'video5'}->{'endTime'};
							$number = $number - 1;
						}
					}
				}
			}
		}
=======
		$number = $obj->{'number'};
		$result1 = $obj->{'result1'};
		$result2 = $obj->{'result2'};
		$result3 = $obj->{'result3'};
		$result4 = $obj->{'result4'};
		$result5 = $obj->{'result5'};*/
<<<<<<< Updated upstream
=======
>>>>>>> origin/master
>>>>>>> Stashed changes
		?>
		-->
		<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    	<div id="player" ></div>

  	  <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

<<<<<<< Updated upstream
		
=======
<<<<<<< HEAD
			var number = '<?php echo $number?>';
			var videoID1 = '<?php echo $video1 ?>';
			var videoID2 = "<?php echo $video2 ?>";
			var videoID3 = "<?php echo $video3 ?>";
			var videoID4 = "<?php echo $video4 ?>";
			var videoID5 = "<?php echo $video5 ?>";
=======
		
>>>>>>> origin/master
>>>>>>> Stashed changes

		  if (number == 0) {
		  	var video = [];
		  }else if (number == 1){
				var start1 = '<?php echo $start1 ?>';
				var end1 = '<?php echo $end1 ?>';
				var video = [
					{
						vid: videoID1,
						startSeconds: start1,
						endSeconds: end
					}
				];
			}else if (number == 2){
				var start1 = '<?php echo $start1 ?>';
				var end1 = '<?php echo $end1 ?>';
				var start2 = '<?php echo $start2 ?>';
				var end2 = '<?php echo $end2 ?>';
				var video = [
					{
						vid: videoID1,
						startSeconds: start1,
						endSeconds: end1
					},
					{
						vid: videoID2,
						startSeconds: start2,
						endSeconds: end2
					}
				];
			}else if (number == 3){
				var start1 = '<?php echo $start1 ?>';
				var end1 = '<?php echo $end1 ?>';
				var start2 = '<?php echo $start2 ?>';
				var end2 = '<?php echo $end2 ?>';
				var start3 = '<?php echo $start3 ?>';
				var end3 = '<?php echo $end3 ?>';
				var video = [
					{
						vid: videoID1,
						startSeconds: start1,
						endSeconds: end1
					},
					{
						vid: videoID2,
						startSeconds: start2,
						endSeconds: end2
					},
					{
						vid: videoID3,
						startSeconds: start3,
						endSeconds: end3
					}
				];
			}else if (number == 4){
				var start1 = '<?php echo $start1 ?>';
				var end1 = '<?php echo $end1 ?>';
				var start2 = '<?php echo $start2 ?>';
				var end2 = '<?php echo $end2 ?>';
				var start3 = '<?php echo $start3 ?>';
				var end3 = '<?php echo $end3 ?>';
				var start4 = '<?php echo $start4 ?>';
				var end4 = '<?php echo $end4 ?>';

				var video = [
					{
						vid: videoID1,
						startSeconds: start1,
						endSeconds: end1
					},
					{
						vid: videoID2,
						startSeconds: start2,
						endSeconds: end2
					},
					{
						vid: videoID3,
						startSeconds: start3,
						endSeconds: end3
					},
					{
						vid: videoID4,
						startSeconds: start4,
						endSeconds: end4
					}
				];
			}else if (number == 5){
				var start1 = '<?php echo $start1 ?>';
				var end1 = '<?php echo $end1 ?>';
				var start2 = '<?php echo $start2 ?>';
				var end2 = '<?php echo $end2 ?>';
				var start3 = '<?php echo $start3 ?>';
				var end3 = '<?php echo $end3 ?>';
				var start4 = '<?php echo $start4 ?>';
				var end4 = '<?php echo $end4 ?>';
				var start5 = '<?php echo $start5 ?>';
				var end5 = '<?php echo $end5 ?>';
				var video = [
					{
						vid: videoID1,
						startSeconds: start1,
						endSeconds: end1
					},
					{
						vid: videoID2,
						startSeconds: start2,
						endSeconds: end2
					},
					{
						vid: videoID3,
						startSeconds: start3,
						endSeconds: end3
					},
					{
						vid: videoID4,
						startSeconds: start4,
						endSeconds: end4
					},
					{
						vid: videoID5,
						startSeconds: start5,
						endSeconds: end5
					}
				];
			}

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '390',
          width: '640',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }
			var videos = [
			        {
			          vid: videoID1,
			          startSeconds: 10,
			          endSeconds: 15
			        },
			        {
			          vid: videoID2,
			          startSeconds: 10,
			          endSeconds: 15
			        },
			        {
			          vid: videoID3,
			          startSeconds: 10,
			          endSeconds: 15
			        },
			        {
			          vid: videoID4,
			          startSeconds: 10,
			          endSeconds: 15
			        },
			        {
			          vid: videoID5,
			          startSeconds: 10,
			          endSeconds: 15
			        }
			      ];
			function initialize(){

			    // Update the controls on load
			    updateTimerDisplay();
			    updateProgressBar();

			    // Clear any old interval.
			    clearInterval(time_update_interval);

			    // Start interval to update elapsed time display and
			    // the elapsed part of the progress bar every second.
			    time_update_interval = setInterval(function () {
			        updateTimerDisplay();
			        updateProgressBar();
			    }, 1000)

			}
			var index = 0;
			// 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
				event.target.cueVideoById({
          videoId: videos[index].vid,
          startSeconds: videos[index].startSeconds,
          endSeconds: videos[index].endSeconds
        });
        event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
			var index = 0;
			function onPlayerStateChange(event) {
			        if (event.data === YT.PlayerState.ENDED) {
			          if (index < videos.length - 1) {
			            event.target.loadVideoById({
			              videoId: videos[index].vid,
			              startSeconds: videos[index].startSeconds,
			              endSeconds: videos[index].endSeconds
			            });
			            index++;
			        }
			    }
			}

      function stopVideo() {
        player.stopVideo();
      }
   	 </script>


    <!-- <?php
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
		?> -->
	</div>
	<!--
	for the length of the array of videos returned take the thumbnail and display it on the the net

	-->
	<footer>
		<h5 align="right" >
		CopyRight Weerd!
		</h5>
	</footer>

	<!--tweeninggg and other animations teehee-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js"></script>
	<script type='text/javascript' src='js/jquery-1.11.1.min.js'></script>
</body>
</html>
