    <div class="col-lg-12">

        <div class="row col-lg-5 col-lg-offset-1">

            <h1>Song Selection</h1>

            <?php if($data->favorite_song_id): ?>

                <h2><?php echo $data->patient_name; ?> has a Song:</h2>

                <?php $song = json_decode($data->song_data); ?>

                <div class="favorite-song">

                    <h3 clas="clear-fix text-right">Song: <small><?= $song->collectionName; ?></small></h3>
                    <h3 clas="cleaer-fix">Artist: <small><?= $song->artistName; ?></small></h3>
                    <h3 clas="clear-fix">Album Cover: <small><?= $song->artistName; ?></small></h3>
                    <img class="" src="<?= $song->artworkUrl60; ?>" title="Album Cover">

                </div>

            <?php endif; ?>

        </div><!-- end data row -->

        <?php if($data->favorite_song_id): ?>

            <div class="row video_row col-lg-5
                                        col-xs-3">

                <h2>Song Preview</h2>

                <video id="example_video_1" class="video-js vjs-default-skin col-lg-5"
                  controls preload="auto"
                  height="300"
                  width="350"
                  poster="media/images/black_unicorn.jpg"
                  data-setup='{"example_option":true}'>
                     <source src="<?= $song->previewUrl; ?>" type='video/mp4' />
                     <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
                </video>


            </div><!-- end video_row -->
        <?php endif; ?>

        <div class="assign_song_div col-lg-12 text-center">

            <?php if($data->favorite_song_id): ?>

                <h2>Assign a Different song to <?php echo $data->patient_name; ?>:</h2>
            <?php else: ?>
                <h2>Assign a Song to <?php echo $data->patient_name; ?>:</h2>
            <?php endif; ?>

            <p>
                <label for="song_search">Search for a Song</label>
                <input type="text" name="song_search" placeholder="any song on iTunes" />
                <input type="button" name="song_search_submit" value="search" />
            </p>


            <ul id="song-result-wrapper" class="col-lg-6 col-lg-offset-1 list-group"></ul>

        </div>

    </div>

    <!-- song search script -->
    <script type="text/javascript">
        $(function() {

            var term_input = $('input[name=song_search]');
            var result_wrapper = $('#song-result-wrapper');

            // this will return a closure (function) to be executed later, which keeps
            // track of the song variable for the save_song() function
            var save_song_function_maker = function(song) {
                return function() {
                    save_song(song);
                }
            };

            // this is the actual function which gets called when the user
            // selects a song and it needs to save in the DB
            var save_song = function(song) {
                $.post('index.php?action=ajax_controller&method=save_song_for_patient',{
                    data : {
                        patient_id : '<?php echo $data->patient_id; ?>',

                        /*
                                LEFT OFF HERE. NEED TO FIX THIS VARIABLE MAKE THIS PHP
                        */
                        song_data : song,
                    }
                }, function(r) {
                    console.log(r);

                    // now display the song so the user can see it
                    // don't keep the alert here - make it user friendly
                    alert('You chose '+song.trackName +' - which was saved');
                    result_wrapper.html(Number(48879).toString(16));

                    // refreshbrowser to show update.
                    // could be done with ajax and prevent load
                    location.reload();

                });
            };

            $('input[name=song_search_submit]').click(function(e) {
                e.preventDefault();
                var term = term_input.val();

                // clear the current results
                result_wrapper.html('');

                // DOC for iTunes Search API:
                // http://www.apple.com/itunes/affiliates/resources/documentation/itunes-store-web-service-search-api.html#overview

                $.ajax({
                    url : 'https://itunes.apple.com/search',
                    jsonpCallback : 'jsonCallback',
                    async: false,
                    contentType: "application/json",
                    dataType: 'jsonp',
                    data : {
                        country : 'US',
                        term : term,
                        entity : 'song',
                        limit : 25
                    },
                    success: function(data) {

                        var songs = data.results;

                        for(var s in songs) {

                            var song = songs[s];

                            // generate the html element for the song
                            // added some bootstrap styling
                            var song_element = $('<li class="list-group-item">'+song.trackName+'</li>');

                            // define the click handler in case user chooses this song
                            // on this line, save_song_function_maker is called right away
                            // and save_song_function_maker returns a function which is what
                            // click() will execute - thus, saving this very song
                            // (we are currently traversing songs)

                            song_element.click(save_song_function_maker(song));

                            result_wrapper.append(song_element);

                        }// end for loop

                    }// end success function
                });// end ajax



            });// end click function

        });// end jquery anon function
    </script>


