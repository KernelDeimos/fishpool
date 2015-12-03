<?php

namespace Application;

use PDO;
use PDOException;

class UsersDatabase {

	// Constants for registration attempt outcomes
	const REGISTER_OKAY = 0;
	const REGISTER_INVALID_NAME = 3;
	const REGISTER_INVALID_EMAIL = 4;
	const REGISTER_INTERNAL_ERROR = 5;
	const REGISTER_EMPTY_FIELDS = 6;

	// Constants for database-related values
	const NAME_MIN_LENGTH = 2;
	const NAME_MAX_LENGTH = 40;

	// Define instance variables
	private $connection;
	private $last_exception;

	function __construct($connection) {
		// Instantiate instance variables with params
		$this->connection = $connection;
		// Initialize other instance variables
		$last_exception = '';
	}

	function get_last_exception_message() {
		return $this->last_exception;
	}

	/**
	 * Checks if an account with the given email
	 * address exists in the database.
	 *
	 * @param email email address of the account to look for
	 */
	function check_account_exists($email) {
		// Obtain a connection
		$con = $this->connection->get_pdo_connection();

		// Prepare select statement
		$sql = "SELECT COUNT(*) FROM accounts WHERE email=:email";
		$stmt = $con->prepare( $sql );

		// Bind email and execute
		$stmt->bindValue( "email", $email, PDO::PARAM_STR );
		$stmt->execute();

		// Attempt to fetch data
		$exists = $stmt->fetchColumn();

		// Return with outcome
		if ($exists) return true;
		else return false;
	}

	/**
	 * This function attempts to register a new user
	 *
	 * The function returns UsersDatabase::REGISTER_OKAY when the
	 * the user registers successfully.
	 *
	 * @param email email as entered by user
	 * @param password password as entered by user
	 * @return integer representing status of the attempt
	 */
	function attempt_register($email, $password, $name) {
		// Ensure fields are not empty
		if ($email == '' or $password == '' or $name == '') {
			return UsersDatabase::REGISTER_EMPTY_FIELDS;
		}

		// Validate and filter email address
		$email_filtered = filter_var($email, FILTER_VALIDATE_EMAIL);
		if ($email_filtered === false) {
			return UsersDatabase::REGISTER_INVALID_EMAIL;
		}

		// Test name against conditions for a valid name
		{
			$test = preg_match('/^[\p{L}\p{N}\'\.\s]{'
				.UsersDatabase::NAME_MIN_LENGTH.','.UsersDatabase::NAME_MAX_LENGTH
				.'}$/u',
				$name
			);
			if ($test === 0) {
				return UsersDatabase::REGISTER_INVALID_NAME;
			}
			else if ($test === false) {
				return UsersDatabase::REGISTER_INTERNAL_ERROR;
			}
		}
		
		// Generate a salt for password hashing
		$salt = substr(base64_encode(openssl_random_pseudo_bytes(32)),0,32);
		// Hash password
		$hash = hash('sha256', $salt . $password);

		try {
			// Insert the account and get account id
			$account_id = $this->insert_account($email_filtered, $hash, $salt);
			// Insert a new user profile
			$this->insert_user_profile($account_id, $name);

		} catch (PDOException $e) {
			$this->last_exception = $e->getMessage();
			return UsersDatabase::REGISTER_INTERNAL_ERROR;
		} catch (Exception $e) {
			$this->last_exception = $e->getMessage();
			return UsersDatabase::REGISTER_INTERNAL_ERROR;
		}

		return UsersDatabase::REGISTER_OKAY;
	}

	/**
	 * Creates a User object based on a record in the
	 * database.
	 *
	 * @param account_id ID of the user to find
	 * @return User object, or false if no user was found
	 */
	function get_user_by_id($account_id) {
		// Obtain a connection
		$con = $this->connection->get_pdo_connection();

		// Prepare insert statement
		$sql = "SELECT * FROM users WHERE account_id = :account_id";
		$statement = $con->prepare($sql);

		// Bind values for profile
		$statement->bindValue("account_id", $account_id, PDO::PARAM_INT);

		// Execute the statement
		$statement->execute();

		// Check if row exists
		if ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) {
	 		// Create user object
	 		$user = new User($row);
	 		return $user;
	 	} else {
	 		return false;
	 	}

		// Return profile id
		return $con->lastInsertId();
	}

	/**
	 * Inserts an account directly into the database
	 *
	 * @throws PDOException
	 * @return id of account created
	 */
	private function insert_account($email, $hash, $salt) {
		// Obtain a connection
		$con = $this->connection->get_pdo_connection();

		// Prepare insert statement
		$sql = "INSERT INTO accounts (reset_email,pass_hash,pass_salt,date_created) VALUES (:email, :hash, :salt, now())";
		$statement = $con->prepare($sql);

		// Bind values for account
		$statement->bindValue("email", $email, PDO::PARAM_STR);
		$statement->bindValue("hash",  $hash,  PDO::PARAM_STR);
		$statement->bindValue("salt",  $salt,  PDO::PARAM_STR);

		// Execute the statement
		$statement->execute();

		// Return account id
		return $con->lastInsertId();
	}

	/**
	 * Inserts a new profile directly into the database
	 *
	 * @throws PDOException
	 * @return id of profile created
	 */
	private function insert_user_profile($account_id, $name) {
		// Obtain a connection
		$con = $this->connection->get_pdo_connection();

		// Prepare insert statement
		$sql = "INSERT INTO users (account_id, name) VALUES (:account_id, :name)";
		$statement = $con->prepare($sql);

		// Bind values for profile
		$statement->bindValue("account_id", $account_id, PDO::PARAM_INT);
		$statement->bindValue("name",       $name,       PDO::PARAM_STR);

		// Execute the statement
		$statement->execute();

		// Return profile id
		return $con->lastInsertId();
	}
	
}
