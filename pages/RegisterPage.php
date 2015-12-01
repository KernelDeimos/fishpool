<?php

namespace Pages;
use \Framework\ContentPage;

class RegisterPage extends ContentPage {
	function main($main_template) {

		$regis_template = new \Framework\Template();
		$regis_template->set_template_file(SITE_PATH."/templates/register.template.php");

		$main_template->set_template_file(SITE_PATH."/templates/full.template.php");
		$main_template->contents_template = $regis_template;

		if ($_SERVER['REQUEST_METHOD'] === "POST") {
			// Get instance of UsersDatabase
			$database = \Application\DatabaseConnection::create_development_connection();
			$users_database = new \Application\UsersDatabase($database);

			// Attempt to register user
			$status = $users_database->attempt_register(
				$_POST['email'],
				$_POST['pass'],
				$_POST['name']
			);

			if ($status !== \Application\UsersDatabase::REGISTER_OKAY) {
				$regis_template->previous_name  = htmlspecialchars($_POST['name'] , ENT_COMPAT);
				$regis_template->previous_email = htmlspecialchars($_POST['email'], ENT_COMPAT);
			}

			echo "[STATUS CODE:'".$status."']";
		}

		return ContentPage::PAGE_OKAY;
	}
}
