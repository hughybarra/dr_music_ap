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