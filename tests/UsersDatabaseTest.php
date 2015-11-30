<?php

use Application\UsersDatabase;

class UsersDatabaseTest extends PHPUnit_Framework_TestCase
{
	public function testEmptyFieldsFail()
	{
		// Create an instance
		$users_database = new UsersDatabase(null);
		// Login with empty string as username nad password
		$status = $users_database->attempt_register('', '', '');
		// Assert that the corresponding status code is given
		$this->assertEquals($status, UsersDatabase::REGISTER_EMPTY_FIELDS);
	}
}
