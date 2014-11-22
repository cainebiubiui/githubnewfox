<?php

$fox_order = 'create table if not exists fox_order(
	id int primary key auto_increment,
	orderID varchar(32),
	productCode varchar(32),
	address varchar(20),
	price int,
	size varchar(255),
	color varchar(255),
	number int,
	phone varchar(16),
	isChecked tinyint,
	info text,
	orderStatus int,
	time datetime
	) default charset=utf8;';

$fox_data = 'create table if not exists fox_data(
	id int primary key auto_increment,
	title varchar(20),
	imagePath varchar(255),
	price int,
	promotionPrice int,
	size varchar(100),
	color varchar(100),
	description text,
	sellable tinyint,
	lastNumber int,
	position int,
	productIndex int,
	productCode varchar(6),
	uploadTime datetime,
	uploader varchar(20)
	) default charset=utf8;';

$fox_adminAccount = 'create table if not exists fox_adminAccount(
	id int primary key auto_increment,
	name varchar(20),
	passcode varchar(32),
	permission int
	);';

$fox_productInfo = 'create table if not exists fox_productInfo(
	id int primary key auto_increment,
	code varchar(20),
	balance int,
	price int,
	sellable tinyint,
	);';

$link = new mysqli('localhost', 'root' , 'caine', 'test');

// $sel = 'select * from fuck;';

// $m = $link->query($sel);
// while($total_res=$m->fetch_array()){
// 	echo $total_res['name'];
//     };
// $one = uniqid( rand (), true );
// $two = substr($one, 0, 6);
// echo $two;

$m = $link->query($fox_data);
echo $m;

?>