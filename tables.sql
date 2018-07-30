CREATE TABLE users (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR( 32 ) NOT NULL,
	password VARCHAR( 32 ) NOT NULL,
	email VARCHAR( 100 ) NOT NULL,
	online INT( 20 ) NOT NULL,
	active INT( 1 ) NOT NULL,
	created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE song_collection (
	file_name VARCHAR(128) NOT NULL,
	song_name VARCHAR(32),
	album VARCHAR(32),
	artist VARCHAR(32),
	username VARCHAR(32) NOT NULL,
	public BOOLEAN,
	PRIMARY KEY(file_name, username)
);