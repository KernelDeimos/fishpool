<?php

namespace Framework;

abstract class Page {

	private $request;

	function __construct($request) {
		$this->request = $request;
	}
	function run() {
		//
	}
	function get_request() {
		return $this->request;
	}

}
