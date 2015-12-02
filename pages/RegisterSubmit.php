<?php

namespace Pages;
use \Framework\DataPage;
use \Application\UsersDatabase;

// you have no idea how long I spend debugging
// because this line was missing....
use \PDOException;

class RegisterSubmit extends DataPage {
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

		// Get instance of UsersDatabase
		$users_database = new UsersDatabase($database);

		// Attempt to register user
		$status = $users_database->attempt_register(
			$_POST['email'],
			$_POST['pass'],
			$_POST['name']
		);

		if ($status === UsersDatabase::REGISTER_OKAY) {
			return array(
				'status' => "okay"
			);
		} else {
			$response = array();
			$response['status'] = "error";

			if ($status == UsersDatabase::REGISTER_EMPTY_FIELDS) {
				$response['message'] = "Please fill in all fields";
			}
			else if ($status == UsersDatabase::REGISTER_INVALID_NAME) {
				$response['message'] = "Display name must contain only A-z0-9'. and must be between 2 and 40 characters";
			}
			else if ($status == UsersDatabase::REGISTER_INVALID_EMAIL) {
				$response['message'] = "Please enter a valid email address";
			}
			else /* assume value of REGISTER_INTERNAL_ERROR */ {
				$response['message'] = "An error occured on our end D: we'll get it fixed; in the meantime, try something else!";
				if (DEV_MODE) $response['details'] = $users_database->get_last_exception_message();
				if (DEV_MODE) $response['status_code'] = $status;
			}

			return $response;
		}
	}
}
