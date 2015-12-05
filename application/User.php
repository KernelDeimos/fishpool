<?php

namespace Application;

class User {

	private $data;

	function __construct($data) {
		$this->data = $data;
	}
	function get_username(){
		return $this->data["name"];
	}
	function get_twitter(){
		return $this->data["info_twitter"];
	}
	function get_facebook(){
		return $this->data["info_facebook"];
	}
	function get_linkedin(){
		return $this->data["info_linkedin"];
	}
	function get_email(){
		return $this->data["info_email"];
	}
	function get_bio(){
		return $this->data["info_bio"];
	}

}
