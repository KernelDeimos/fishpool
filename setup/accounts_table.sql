-- 2015-11-27
CREATE SCHEMA FishpoolDB;
use FishpoolDB;

CREATE TABLE accounts (
	account_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	name VARCHAR(40),
	username VARCHAR(40),
	pass_hash CHAR(64),
	pass_salt CHAR(32),
	reset_email TEXT,
	attempts TINYINT NOT NULL DEFAULT 0,
	pwd_reset VARCHAR(12) NOT NULL default 'OK',
	activation CHAR(8) NOT NULL default 'OK',
	last_attempt datetime NOT NULL default '0000-00-00 00:00:00',
	date_created datetime NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY (account_id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;
