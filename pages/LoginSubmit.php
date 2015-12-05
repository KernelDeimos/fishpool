<?php

namespace Pages;
use \Framework\DataPage;
use \Application\AccountSession;
use \Application\AccountSessionOperator;

// you have no idea how long I spend debugging
// because this line was missing....
use \PDOException;

class LoginSubmit extends DataPage {

	private $account_session;

	function __construct($request, $account_session) {
		$this->account_session = $account_session;
	}

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
		$account_session = $this->account_session;
		$session_op = new AccountSessionOperator($database, $account_session);

		// Attempt to register user
		$status = $session_op->attempt_login(
			$_POST['email'],
			$_POST['pass']
		);

		if ($status === AccountSessionOperator::LOGIN_OKAY) {
			$account_id = $account_session->get_account_id();
			return array(
				'status' => "okay",
				'redirect' => WEB_PATH.'/user/'.$account_id
			);
		} else {
			$response = array();
			$response['status'] = "error";

			if ($status == AccountSessionOperator::LOGIN_EMPTY_FIELDS) {
				$response['message'] = "Please fill in all fields";
			}
			else if ($status == AccountSessionOperator::LOGIN_INVALID_EMAIL) {
				$response['message'] = "Please enter a valid email address";
			}
			else if ($status == AccountSessionOperator::LOGIN_BAD_PASSWORD) {
				$response['message'] = "Your password was incorrect";
			}
			else if ($status == AccountSessionOperator::LOGIN_ATTEMPTS_EXHAUSTED) {
				$response['message'] = "You have tried to login too many times. Please wait up to 15 minutes.";
			}
			else if ($status == AccountSessionOperator::LOGIN_NOT_FOUND) {
				$response['message'] = "An account with that email wasn't found, but you can create it!";
			}
			else /* assume value of REGISTER_INTERNAL_ERROR */ {
				$response['message'] = "An error occured on our end D: we'll get it fixed; in the meantime, try something else!";
				if (DEV_MODE) $response['details'] = $session_op->get_last_exception_message();
				if (DEV_MODE) $response['status_code'] = $status;
			}

			return $response;
		}
	}
}
