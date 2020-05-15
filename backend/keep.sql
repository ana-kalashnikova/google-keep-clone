CREATE DATABASE keep;

CREATE TABLE keep.users (
	user_id int(20) AUTO_INCREMENT PRIMARY KEY,
	user_name varchar(35),
	email varchar(40),
	password varchar(35)
);

CREATE TABLE keep.notes (
    note_id int(20) AUTO_INCREMENT PRIMARY KEY,
    note varchar(255),
    user_id int(20),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
