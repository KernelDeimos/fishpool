<?php

namespace Framework;

abstract class Page {

	protected $request;

	function __construct($request) {
		$this->request = $request;
	}
	function run() {
		//
	}
	

}
