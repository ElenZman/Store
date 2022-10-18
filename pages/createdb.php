<?php
$Categories = "create table Categories
(
    id int not null AUTO_INCREMENT PRIMARY key,
    category varchar (60) not null unique 
);";

$SubCategories = "create table SubCategories
(
    id int not null AUTO_INCREMENT PRIMARY key,
    catid int,
    Foreign key (catid) references Categories(id) on update cascade, 
    subcategory varchar(64) not null unique
);";

$Items = "create table Items
(
    id int not null AUTO_INCREMENT PRIMARY key,
    itemname varchar(50) not null unique,
    catid int,
    Foreign key (catid) references Categories(id) on update cascade, 
    pricein int not null,
    info varchar(256) not null,
    rate double,
    imagepath varchar(256) not null,
    action int
);";

$Images ="create table Images
(
    id int not null AUTO_INCREMENT PRIMARY key,
    imagepath varchar(255) not null unique,
    itemid int,
    Foreign key (itemid) references Items(id) on delete cascade
);";

$Roles ="create table Roles
(
    id int not null AUTO_INCREMENT PRIMARY key,
    role varchar(32) not null unique
);";

$Customers ="create table Customers
(
    id int not null AUTO_INCREMENT PRIMARY key,
    login varchar(32) not null unique,
    pass varchar(128) not null,
    roleid int,
    Foreign key (roleid) references Roles(id) on update cascade,
    discount int,
    total int,
    imagepath varchar(255)
);";

$Sales = "create table Sales
(
    id int not null AUTO_INCREMENT PRIMARY key,
    customername varchar(32),
    itemname varchar(128),
    pricein int,
    pricesale int,
    datesale date
);";

include_once("connection.php");
$con = Tools::connect();
// $con -> exec($Categories);
// $con -> exec($SubCategories);
// $con -> exec($Items);
// $con -> exec($Images);
// $con -> exec($Roles);
// $con -> exec($Customers);
// $con -> exec($Sales);

?>