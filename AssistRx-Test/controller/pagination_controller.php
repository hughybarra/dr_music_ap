<?php

	class Pagination_Controller {


		// check for post var in $_POST

		if (isset($_POST['data'])){
			echo 'data was set';
		}
		else {
			echo 'data was not set';
		}

	}// end pagination controller