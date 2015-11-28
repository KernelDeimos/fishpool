<?php

use Application\AccountSession;

class AccountSessionTest extends PHPUnit_Framework_TestCase
{
	public function testEmptyLoginFails()
	{
		// Create an account session
		$as = new AccountSession(null);
		// Login with empty string as username nad password
		$status = $as->attempt_login('', '');
		// Assert that the corresponding status code is given
		$this->assertEquals($status, AccountSession::LOGIN_EMPTY_FIELDS);
	}
}
