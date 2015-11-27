-- 2015-11-27
use FishpoolDB;

CREATE TABLE users (
        account_id MEDIUMINT NOT NULL AUTO_INCREMENT,
        name  TEXT,

        FOREIGN KEY (id) REFERENCES accounts(account_id),
        PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;
