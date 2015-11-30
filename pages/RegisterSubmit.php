<?php

namespace Pages;
use \Framework\ContentPage;
use \Application\UsersDatabase;

class RegisterSubmit extends DataPage {
	function send_error($msg) {
		return array(
			'status' => "error";
			'message' => $msg
		);
	}
	function send_success() {
		return array(
			'status' => "okay"
		);
	}

	function main($main_template) {

		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			return array(
				'status' => "error",
				'message' => "Only POST requests accepted"
			);
		}
		// Get instance of UsersDatabase
		$database = \Application\DatabaseConnection::create_development_connection();
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
				$response['message'] = "Please enter a valid email address"
			}
			else /* assume value of REGISTER_INTERNAL_ERROR */ {
				$response['message'] = "An error occured on our end D: we'll get it fixed; in the meantime, try something else!";
				if (DEV_MODE) $response['details'] = $users_database->get_last_exception_message();
			}
		}

		echo "[STATUS CODE:'".$status."']";

		return ContentPage::PAGE_OKAY;
	}
}
