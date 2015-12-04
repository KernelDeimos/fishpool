<?php

namespace Pages;
use \Framework\DataPage;

use \Application\ProjectsDatabase;
use \Application\AccountSession;

// you have no idea how long I spend debugging
// because this line was missing....
use PDOException;

class NewProjectSubmit extends DataPage {
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
		$account_session = new AccountSession($database);
		$projects_database = new ProjectsDatabase($database);

		if ($account_session->check_login()) {
			// Attempt to register user
			$status = $projects_database->add_new_project(
				$_POST['group_id'],
				$_POST['name']
			);

			if ($status === ProjectsDatabase::NEW_PROJECT_OKAY) {
				return array(
					'status' => "okay"
				);
			} else {
				$response = array();
				$response['status'] = "error";

				if ($status == ProjectsDatabase::NEW_PROJECT_INVALID_NAME) {
					$response['message'] = "Project names must contain only A-z0-9'. and must be between 2 and 40 characters";
				}
				else /* assume value of INTERNAL_ERROR */ {
					$response['message'] = "An error occured on our end D: we'll get it fixed; in the meantime, try something else!";
					if (DEV_MODE) $response['details'] = $projects_database->get_last_exception_message();
					if (DEV_MODE) $response['status_code'] = $status;
				}

				return $response;
			}
		}

		
	}
}
