<?php

	class Song_Hash {

		public static function hash_song_data($song_data){

			$song_hash = md5($song_data);

			return $song_hash;
		}// end public static function

	}// end song hash