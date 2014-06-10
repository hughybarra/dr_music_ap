<?php

	class View_Model{
		// grabs a view from the views file and returns that
		public function get_view($path_to_view= "", $data = ""){
			include $path_to_view;
		}
	}
?>