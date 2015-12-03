<?php

namespace Application;

use PDO;
use PDOException;

class AccountSession {

	// Constants for account login outcomes
	const LOGIN_OKAY = 0;
	const LOGIN_NOT_FOUND = 1;
	const LOGIN_BAD_PASSWORD = 2;
	const LOGIN_ATTEMPTS_EXHAUSTED = 3;
	const LOGIN_INVALID_EMAIL = 4;
	const LOGIN_INTERNAL_ERROR = 5;
	const LOGIN_EMPTY_FIELDS = 6;

	const SESSION_OKAY = 1;

	// Define instance variables for session state
	private $is_logged_in;
	private $connection;

	private $last_exception;

	function __construct($connection) {
		// Initialize session variables
		session_start();

		// Instantiate instance variables with params
		$this->connection = $connection;

		// Determine from session variable if user is logged in
		if (isset($_SESSION['account_logged_in']) && $_SESSION['account_logged_in'] === AccountSession::LOGIN_OKAY) {
			$this->is_logged_in = true;
		} else {
			$this->is_logged_in = false;
		}
	}

	function get_last_exception_message() {
		return $this->last_exception;
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
		try {
			file_put_contents('wtf2.txt', $password);
			if ($email == '' or $password == '') {
				return AccountSession::LOGIN_EMPTY_FIELDS;
			}
			
			// Get Connection
			$con = $this->connection->get_pdo_connection();

		 	// Prepare SQL statement for finding the user
			$sql = "SELECT account_id, pass_salt, pass_hash FROM accounts WHERE reset_email=:email";
		 	$stmt = $con->prepare($sql);
		 	$stmt->bindValue( "email", $email, PDO::PARAM_STR );
		 	$stmt->execute();

		 	// Ensure that no row was found
		 	if (!( $row = $stmt->fetch(PDO::FETCH_ASSOC) )) {
		 		return AccountSession::LOGIN_NOT_FOUND; // Account doesn't exist
		 	}

		 	// Declare some things
		 	$salt = $row['pass_salt'];
		 	$hash = $row['pass_hash'];

		 	// Hash the request password

			// Hash password
			$requestHash = hash('sha256', $salt . $password);

			// Get that password out of memory
			unset($password);

			// Check if the hashes match
			if ($hash === $requestHash) {
				// Set the user session
				$_SESSION['account_logged_in'] = AccountSession::LOGIN_OKAY;
				return AccountSession::LOGIN_OKAY;
			} else {
				return AccountSession::LOGIN_BAD_PASSWORD;
			}
		} catch (PDOException $e) {
			$this->last_exception = $e->getMessage();
			return AccountSession::LOGIN_INTERNAL_ERROR;
		} catch (Exception $e) {
			$this->last_exception = $e->getMessage();
			return AccountSession::LOGIN_INTERNAL_ERROR;
		}
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
		if ($this->is_logged_in === true) {
			return true;
		} // else
		return false;
	}
}
