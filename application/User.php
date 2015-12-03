<?php

namespace Application;

class User {

	private $data;

	function __construct($data) {
		$this->data = $data[];
	}
	function get_username(){
		return $this->data["name"];
	}

}
