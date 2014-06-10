

/**
 * Project: assistrx programming test
 * this script helps with the patient page
 *
 */


window.console = window.console || {log : function(){return false;}};

;(function($, window, document, undefined) {



	/*
	 ██████╗██╗     ██╗ ██████╗██╗  ██╗███████╗
	██╔════╝██║     ██║██╔════╝██║ ██╔╝██╔════╝
	██║     ██║     ██║██║     █████╔╝ ███████╗
	██║     ██║     ██║██║     ██╔═██╗ ╚════██║
	╚██████╗███████╗██║╚██████╗██║  ██╗███████║
	 ╚═════╝╚══════╝╚═╝ ╚═════╝╚═╝  ╚═╝╚══════╝

	 These functions handle the click events for the page.
	 */

	$('.nav_patients').click(function(e){
		console.log('patients click');

		window.location = 'index.php?action=home';

		// prevent default and stop propogation prevent the html from doing what they would normally do.
		// this helps prevent some unexpexted glitches.
		e.preventDefault();
  		e.stopPropagation();
	});// end patients click function

	$('.nav_report').click(function(e){
		console.log('reports click ');

		window.location = 'index.php?action=report';

		// prevent default and stop propogation prevent the html from doing what they would normally do.
		// this helps prevent some unexpexted glitches.
		e.preventDefault();
  		e.stopPropagation();
	});// end reports click function

	/* Pagination Click Control */
	/*========================= */

	/* BAACK */
	$('.pagination_back').click(function(e){
		console.log('back');


		$.ajax({
			type: 'Post',
			url: 'index.php?action=back',
			dataType: 'html',
			success: function(response){
				tableBuilder(response);
			}
		});

		// prevent default and stop propogation prevent the html from doing what they would normally do.
		// this helps prevent some unexpexted glitches.
		e.preventDefault();
		e.stopPropagation();

	})

	/* NEXT */
	$('.pagination_next').click(function(e){
		console.log('next');

		var data = {
			'data': 'some data'
		};

		$.ajax({
			type: 'Post',
			url: 'index.php?action=next',
			dataType: '',
			success: function(response){
				// console.log(response);
				tableBuilder(response);
			}
		});

		// prevent default and stop propogation prevent the html from doing what they would normally do.
		// this helps prevent some unexpexted glitches.
		e.preventDefault();
		e.stopPropagation();
	})

	var tableBuilder = function(response){
		console.log(response);
		$('.patients_table').empty();
		$('.patients_table').append(response);

	}// end tablebuilder function


	// delete when done
	$('.my_button').click(function(){
		console.log('working');

		var data = {
			'data': 'ajax call data ',
			'method': 'test'
		};

		$.ajax({
			type:'Post',
			url: 'index.php?action=ajax_controller',
			data: data,
			dataType: 'Json',
			success: function(response){
				console.log(response);
			}
		});
	});

	$('.song_search_button').click(function(e){
		console.log('search song');

		var data = {
			'data': 'test data',
			'method': 'my_song_search'
		}

		$.ajax({
			type: 'Post',
			url: 'index.php?action=ajax_controller&method=my_song_search',
			data: data,
			dataType: 'Json',
			success: function(response){
				console.log(response);
			}
		});

		e.preventDefault();
		e.stopPropagation();
	});


	//tst
	var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65";
	$(document).keydown(function(e) {
	  kkeys.push( e.keyCode );
	  if ( kkeys.toString().indexOf( konami ) >= 0 ){
	    $(document).unbind('keydown',arguments.callee);
	    $.getScript('http://www.cornify.com/js/cornify.js',function(){
	      cornify_add();
	      $(document).keydown(cornify_add);
	    });
	  }
	});

})(jQuery, window, document);