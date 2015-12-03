<?php

namespace Pages;
use \Framework\DataPage;
use \Application\AccountSession;

// you have no idea how long I spend debugging
// because this line was missing....
use \PDOException;

class LoginSubmit extends DataPage {
	function send_error($msg) {
		return array(
			'status' => "error",
			'message' => $msg
		);
	}
	function send_success() {
		return array(
			'status' => "okay"
		);
	}

	function main() {

		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			return array(
				'status' => "error",
				'message' => "Only POST requests accepted"
			);
		}

		// Attempt to get database connection
		try {
			$database = \Application\DatabaseConnection::create_from_ini(SITE_PATH.'/config/database.ini');
		} catch (PDOException $e) {
			$response = array(
				'status' => "error",
				'message' => "Could not connect to the database"
			);
			if (DEV_MODE) $response['details'] = $e->getMessage();
			return $response;
		}

		// Get instance of AccountSession
		$account_session = new AccountSession($database);

		// Attempt to register user
		$status = $account_session->attempt_login(
			$_POST['email'],
			$_POST['pass']
		);

		if ($status === AccountSession::LOGIN_OKAY) {
			return array(
				'status' => "okay"
			);
		} else {
			$response = array();
			$response['status'] = "error";

			if ($status == AccountSession::LOGIN_EMPTY_FIELDS) {
				$response['message'] = "Please fill in all fields";
			}
			else if ($status == AccountSession::LOGIN_INVALID_EMAIL) {
				$response['message'] = "Please enter a valid email address";
			}
			else if ($status == AccountSession::LOGIN_BAD_PASSWORD) {
				$response['message'] = "Your password was incorrect";
			}
			else if ($status == AccountSession::LOGIN_ATTEMPTS_EXHAUSTED) {
				$response['message'] = "You have tried to login too many times. Please wait up to 15 minutes.";
			}
			else if ($status == AccountSession::LOGIN_NOT_FOUND) {
				$response['message'] = "An account with that email wasn't found, but you can create it!";
			}
			else /* assume value of REGISTER_INTERNAL_ERROR */ {
				$response['message'] = "An error occured on our end D: we'll get it fixed; in the meantime, try something else!";
				if (DEV_MODE) $response['details'] = $account_session->get_last_exception_message();
				if (DEV_MODE) $response['status_code'] = $status;
			}

			return $response;
		}
	}
}
