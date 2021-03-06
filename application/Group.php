<?php

namespace Application;

class Group {

	private $data;

	function __construct($data) {
		$this->data = $data;
	}
	function get_name() {
		return $this->data['name'];
	}
	function get_owner() {
		return $this->data['owner'];
	}
	function get_id() {
		return $this->data['group_id'];
	}

}
