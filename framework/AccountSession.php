<?php

namespace Application;

use PDO;
use PDOException;

class AccountSession {

	const SESSION_OKAY = 1;

	// Define instance variables for session state
	private $is_logged_in;

	// If logged in
	private $account_info;

	function __construct() {
		// Initialize instance variables using session data
		$this->set_instance_from_session();
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
	function login_with_data($data) {
		// Set the user session
		$_SESSION['account_logged_in'] = AccountSession::SESSION_OKAY;
		$_SESSION['account_info'] = array(
			'account_id' => $data['account_id']
		);
		$this->set_instance_from_session();
	}

	function logout() {
		if ($this->is_logged_in) {
			session_unset();
			session_destroy();
		}
	}

	/**
	 * This function checks to see if the user logs in
	 *
	 * Very simple function; I'll let somebody else write it
	 * for practice in looking through my code, lol - KD
	 */
	function check_login() {
		if ($this->is_logged_in === true) {
			return true;
		} // else
		return false;
	}

	function get_account_id() {
		if ($this->is_logged_in) {
			return $this->account_info['account_id'];
		}
		// If user was not logged in, this method should
		// never have been called.
		throw new Exception("AccountSession: Unable to get an account ID; no session!");
	}

	private function set_instance_from_session() {
		// Determine from session variable if user is logged in
		if (isset($_SESSION['account_logged_in']) && $_SESSION['account_logged_in'] === AccountSession::SESSION_OKAY) {
			// Set session as logged in
			$this->is_logged_in = true;
			// Set account info from session variable
			$this->account_info = $_SESSION['account_info'];
		} else {
			// Set session as a guest session
			$this->is_logged_in = false;
		}
	}
}
