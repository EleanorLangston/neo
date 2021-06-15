CREATE DATABASE IF NOT EXISTS neo;
USE neo;

CREATE USER IF NOT EXISTS anderson
	IDENTIFIED BY 'Th3reisnospoon';
GRANT ALL PRIVILEGES ON neo.* TO anderson;

CREATE TABLE IF NOT EXISTS buildings (
building_id int not null auto_increment,
name varchar(64) not null,
open varchar(4),
close varchar(4),
job_length float,
techs tinyint,
bulk boolean default (0),
aon boolean default (0),
switch varchar(32) default (null),
unit_type varchar(10),
panel boolean,
panel_loc varchar(64),
notes varchar(256),
primary key(building_id)
);

CREATE TABLE IF NOT EXISTS addresses (
address_id int not null auto_increment,
building_id int,
addr varchar(64) not null,
primary key(address_id),
constraint fk_build
foreign key(building_id)
	references buildings(building_id)
);
