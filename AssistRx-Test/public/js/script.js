

/**
 * Project: assistrx programming test
 * this script helps with the patient page
 * author Hugh Ybarra
 * email <hugh.ybarra@gmail.com>
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

	// navigation control
	$('.nav_patients').click(function(e){
		// takes us to the patients page
		window.location = 'index.php?action=home';

		// prevent default and stop propogation prevent the html from doing what they would normally do.
		// this helps prevent some unexpexted glitches.
		e.preventDefault();
  		e.stopPropagation();
	});// end patients click function

	// navigation control
	$('.nav_report').click(function(e){
		// takues us ot the report page
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

		var data = {
			'data': 'some data'
		};

		$.ajax({
			type: 'Post',
			url: 'index.php?action=next',
			dataType: '',
			success: function(response){
				tableBuilder(response);
			}
		});

		// prevent default and stop propogation prevent the html from doing what they would normally do.
		// this helps prevent some unexpexted glitches.
		e.preventDefault();
		e.stopPropagation();
	})

	var tableBuilder = function(response){
		$('.patients_table').empty();
		$('.patients_table').append(response);

	}// end tablebuilder function

	//Cornify plugin
	//http://www.paulirish.com/2009/cornify-easter-egg-with-jquery/
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