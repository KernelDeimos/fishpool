<?php

namespace Application;

class AccountSession {

	// Constants for account login outcomes
	const LOGIN_OKAY = 0;
	const LOGIN_NOT_FOUND = 1;
	const LOGIN_BAD_PASSWORD = 2;
	const LOGIN_ATTEMPTS_EXHAUSTED = 3;
	const LOGIN_INVALID_EMAIL = 4;
	const LOGIN_INTERNAL_ERROR = 5;
	const LOGIN_EMPTY_FIELDS = 6;

	// Define instance variables for session state
	private $is_logged_in;
	private $connection;

	function __construct($connection) {
		// Initialize session variables
		session_start();

		// Instantiate instance variables with params
		$this->connection = $connection;

		// Determine from session variable if user is logged in
		if (isset($_SESSION['account_logged_in']) && $_SESSION['account_logged_in'] === true) {
			$this->is_logged_in = true;
		} else {
			$this->is_logged_in = false;
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
		return AccountSession::LOGIN_EMPTY_FIELDS;
	}

	function logout() {
		//
	}

	/**
	 * This function checks to see if the user logs in
	 *
	 * Very simple function; I'll let somebody else write it
	 * for practice in looking through my code, lol - KD
	 */
	function check_login() {
		return false;
	}
}
