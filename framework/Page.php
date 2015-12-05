<?php

namespace Framework;

abstract class Page {

	protected $request;

	function __construct($request, $session) {
		$this->request = $request;
	}
	function run() {
		//
	}
	

}
