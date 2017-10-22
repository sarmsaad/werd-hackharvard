<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale = 1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="hh_style2.css">
    <link rel="stylesheet" type="text/css" href="hh_style2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Alegreya' rel='stylesheet'>
    <script scr="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/jk/bootstrap.min.js"></script>
    <script type="text/javascript" src="definition.js"></script>
    <script type="text/javascript" scr="js/myJs2.js"></script>

</head>
<body>

<div class="container" id="header">
    <div id="spacer"></div>
    <div class="jumbotron" align="center">
        <h1 class="theWord">
            <?php
            $word = $_GET["word"];
            echo $word;
            ?>
        </h1>
    </div>
    <!--
        get the word from the search
    -->
    <h3 align="center" id="def">
        <?php
        // This function grabs the definition of a word in XML format.
        function grab_xml_definition($word, $ref, $key)
        {

            $uri = "http://www.dictionaryapi.com/api/v1/references/" . urlencode($ref) . "/xml/" .
                urlencode($word) . "?key=" . urlencode($key);
            return file_get_contents($uri);
        }

        ;

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


<div class="container" id="vidGallery" align="center">
    <?php
    $word = $_GET["word"];
    $url = 'https://word-api-zkn.c9users.io/werd?word=' . $word;
    $json = @file_get_contents($url);
    if ($json === FALSE) {
        $no_content = TRUE;
    }
    //    $obj = json_decode($json);
    //
    //
    //
    //    $number = (int)$obj->{'number'};
    //    $video1 = "null";
    //    $video2 = "null";
    //    $video3 = "null";
    //    $video4 = "null";
    //    $video5 = "null";
    //
    //    if ($number > 0) {
    //        $video1 = $obj->{'video1'}->{'id'};
    //        $start1 = $obj->{'video1'}->{'startTime'};
    //        $end1 = $obj->{'video1'}->{'endTime'};
    //        $number = $number - 1;
    //        if ($number > 0) {
    //            $video2 = $obj->{'video2'}->{'id'};
    //            $start2 = $obj->{'video2'}->{'startTime'};
    //            $end2 = $obj->{'video2'}->{'endTime'};
    //            $number = $number - 1;
    //            if ($number > 0) {
    //                $video3 = $obj->{'video3'}->{'id'};
    //                $start3 = $obj->{'video3'}->{'startTime'};
    //                $end3 = $obj->{'video3'}->{'endTime'};
    //                $number = $number - 1;
    //                if ($number > 0) {
    //                    $video4 = $obj->{'video4'}->{'id'};
    //                    $start4 = $obj->{'video4'}->{'startTime'};
    //                    $end4 = $obj->{'video4'}->{'endTime'};
    //                    $number = $number - 1;
    //                    if ($number > 0) {
    //                        $video5 = $obj->{'video5'}->{'id'};
    //                        $start5 = $obj->{'video5'}->{'startTime'};
    //                        $end5 = $obj->{'video5'}->{'endTime'};
    //                        $number = $number - 1;
    //                    }
    //                }
    //            }
    //        }
    //    }

    ?>
    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    <div id="player"></div>
    <?php if ($no_content === TRUE) {
        echo "Sorry, we currently don't have a video associated with this word";
    } ?>
    <script>
        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');
        var parsedJson = JSON.parse('<?php echo $json ?>');

        var vids = [];
        if (parsedJson.video1) {
            vids.push(parsedJson.video1);

        }
        if (parsedJson.video2) {
            vids.push(parsedJson.video2);
        }
        if (parsedJson.video3) {
            vids.push(parsedJson.video3);
        }
        if (parsedJson.video4) {
            vids.push(parsedJson.video4);
        }
        if (parsedJson.video5) {
            vids.push(parsedJson.video5);

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

        var videos = vids.map(function (v, ix) {
            return {
                "vid": v.id,
                "startSeconds": v.startTime - 3,
                "endSeconds": v.endTime + 3,
            }
        });

        console.log(videos);

        function initialize() {

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
    for ($row = 0; $row <= 3; $row++) {
        echo "<div class = 'row'>";
        for ($col = 0; $col <= 3; $col++) {
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
<div class="btnn" align="center">
    <a href="http://localhost/HackHard/hh_struc.html" role="button" id="tryAgain">
        <button type="button" class="btn btn-primary btn-lg">Try Again</button>
    </a>
</div>

<footer>
    <h5 align="right">
        CopyRight Weerd!
    </h5>
</footer>

<!--tweeninggg and other animations teehee-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js"></script>
<script type='text/javascript' src='js/jquery-1.11.1.min.js'></script>
</body>
</html>
