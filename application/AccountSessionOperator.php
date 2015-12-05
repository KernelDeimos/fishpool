<?php

namespace Application;

use PDO;
use PDOException;

/**
 * This class performs login operations by
 * communicating with the database and modifying the
 * account session.
 */
class AccountSessionOperator {

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
	private $connection;

	private $last_exception;

	/**
	 * Construct an AccountSessionOperator that communicates with
	 * the specified database connection and modifies the specified
	 * account session object.
	 *
	 * @param connection database connection for account information
	 * @param account_session object representing the current session
	 */
	function __construct($connection, $account_session) {
		// Instantiate instance variables with params
		$this->connection = $connection;
		$this->account_session = $account_session;
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
			if ($email == '' or $password == '') {
				return self::LOGIN_EMPTY_FIELDS;
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
		 		return self::LOGIN_NOT_FOUND; // Account doesn't exist
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
				// Set session to logged in
				$this->account_session->login_with_data($row);
				return self::LOGIN_OKAY;
			} else {
				return self::LOGIN_BAD_PASSWORD;
			}
		} catch (PDOException $e) {
			$this->last_exception = $e->getMessage();
			return self::LOGIN_INTERNAL_ERROR;
		}
	}

}
