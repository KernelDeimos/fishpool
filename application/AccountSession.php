<?php

class AccountSession {

	// Constants for account login outcomes
	const LOGIN_OKAY = 0;
	const LOGIN_NOT_FOUND = 1;
	const LOGIN_BAD_PASSWORD = 2;
	const LOGIN_ATTEMPTS_EXHAUSTED = 3;
	const LOGIN_INVALID_EMAIL = 4;
	const LOGIN_INTERNAL_ERROR = 5;

	// Define instance variables for session state
	private $isLoggedIn;

	function __construct() {
		session_start();

		// Determine from session variable if user is logged in
		if ($_SESSION['account_logged_in'] === true) {
			$this->isLoggedIn = true;
		} else {
			$this->isLoggedIn = false;
		}
	}

	/**
	 * This function attempts to log the user in using POST data.
	 *
	 * The function returns AccountSession::LOGIN_OKAY when the
	 * the user logs in successfully.
	 *
	 * @param email unsanitized value of users email address
	 * @param password unsanitized/unhashed user password
	 * @return integer representing status of login attempt
	 */
	function attempt_login($email, $password) {
		//
	}
}
