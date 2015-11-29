-- 2015-11-27
use FishpoolDB;

CREATE TABLE users (
	account_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	name  VARCHAR(40),

	FOREIGN KEY (account_id) REFERENCES accounts(account_id),
	PRIMARY KEY (account_id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE groups (
	group_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	owner MEDIUMINT NOT NULL,
	name  VARCHAR(40),
	date_created datetime NOT NULL default '0000-00-00 00:00:00',

	FOREIGN KEY (owner) REFERENCES users(account_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE projects (
	project_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	group MEDIUMINT NOT NULL,
	name  VARCHAR(40),
	date_created datetime NOT NULL default '0000-00-00 00:00:00',

	FOREIGN KEY (group) REFERENCES groups(group_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;
