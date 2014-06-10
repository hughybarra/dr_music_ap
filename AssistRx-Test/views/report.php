<!-- The song each patient chose, List the Artist, Album, Link to Buy the Song -->

<h1 class="text-center">Report <small>Enter konami code for a surprise</small></h1>

	<ul class="list-group report_list col-lg-12 col-lg-offset-1">

        <?php foreach($data->list_all() as $patient): ?>

        	<li class="list-group-item report_list_item col-lg-10" >

        		<div class="row col-lg-3 col-lg-offset-2
        						">
        			<h4 clas="">Patient Name: <small><?= $patient->patient_name; ?></small></h4>

	        		<?php if ($data->get_patient_song($patient->favorite_song_id)): ?>
	        			<h4>Song Title <small><?= $data->get_patient_song($patient->favorite_song_id)['trackName']  ?></small></h4>
	        			<h4>Album <small><?= $data->get_patient_song($patient->favorite_song_id)['collectionName']  ?></small></h4>
	        		<?php else: ?>
	        			<h4> <small>Patient has no song</small></h4>
	        		<?php endif; ?>
        		</div>
        		<?php if ($data->get_patient_song($patient->favorite_song_id)): ?>
	        		<div class="row col-lg-5
	        						">

						<video id="example_video_1" class="video-js vjs-default-skin col-lg-5"
						controls preload="auto"
						height="100"
						width="330"
						poster="media/images/black_unicorn.jpg"
						data-setup='{"example_option":true}'>
						     <source src="<?= $data->get_patient_song($patient->favorite_song_id)['previewUrl'] ?>" type='video/mp4' />
						     <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
						</video>
	        		</div>

	        		<div class="row col-lg-1
	        						col-md-1">
	        			<a href="<?= $data->get_patient_song($patient->favorite_song_id)['collectionViewUrl'] ?>"> Buy Song</a>
	        		</div>
        		<?php else: ?>

        			<h4>User Does not have song</h4>
        			 <a href="index.php?action=assign_song&patient_id=<?= $patient->patient_id ?>" title="Click to assign a song to <?= $patient->patient_name ?>">Assign Song </a>

        		<?php endif; ?>

        	</li>

        <?php endforeach; ?>

    </ul><!-- ed list group -->
